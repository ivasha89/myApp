<template>
    <div class="row">
        <div class="col-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Чат</div>
                <div class="card-body">
                    <div class="shadow text-center rounded" @click="loadNewData">Предыдущие сообщения</div>
                    <ul class="chat" style="height: 300px; overflow-y:scroll" v-chat-scroll="{always: false}" @scroll-top="loadNewData">
                        <li class="left clearfix" v-for="(message, index) in messages" :key="index">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">
                                        {{ message.user.name }}
                                    </strong>
                                </div>
                                <p>
                                    {{ message.message }}
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="card-footer d-flex">
                        <input
                                id="btn-input"
                                type="text"
                                name="message"
                                class="form-control input-sm"
                                placeholder="Type your message here..."
                                v-model="newMessage"
                                @keyup.enter="sendMessage"
                                @keyup="sendTypingEvent">
                        <button class="ml-2 btn btn-outline-info" @click="sendMessage">
                            Послать
                        </button>
                    </div>
                </div>
            </div>
            <span v-if="activeUser" class="text-muted"> {{ activeUser.name }} печатает...</span>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Кто в чате
                </div>
                <ul class="list-group">
                    <li class="list-group-item" v-for="(user, index) in users" :key="index">
                        {{ user.name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                messages: [],
                newMessage: '',
                users: [],
                activeUser: false,
                typingTimer: false
            }
        },
        created() {
            this.fetchMessages();
            Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                })
                .listenForWhisper('typing', user => {
                    this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.activeUser = false
                    }, 3000)
                    })
                .listen('MessageSent', (event) => {
                    this.messages.push({
                        message: event.message.message,
                        user: event.user
                    });
                });
        },
        methods: {
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
            },
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data.slice(-5)
                }).catch(error => console.log(error));
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('/messages', {message: this.newMessage});
                this.newMessage = ''
            },
            loadNewData() {
                axios.get('messages').then(response => {
                    let k = this.messages.length;
                    k = k + 5;
                    this.messages = response.data.slice(-k);
                }).catch(error => console.log(error));
            }
        }
    };
</script>