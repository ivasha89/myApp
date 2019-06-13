<template>
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">Чат</div>
                <div class="card-body" style="height: 300px; overflow-y:scroll" v-chat-scroll="{always: false}"
                     @scroll-top="loadPreviousMessages()">
                    <div class="shadow text-center rounded" v-if="messages.length < allMessages.length" @click="loadPreviousMessages()">Предыдущие сообщения</div>
                    <div class="container rounded" style="background-color: lightblue" v-for="(message, index) in messages" :key="index"
                          @click="deleteButton(message.id)">
                        <strong>
                            {{ message.user.name }}
                        </strong> :
                        <button v-if="message.user_id === user.id && showEx === message.id" type="button"
                                class="ml-2 mb-1 close hide" @click="deleteMessage(message.id)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <a class="text-break">
                            {{ message.message }}
                        </a>
                        <p class="mb-1 text-muted text-right">
                            {{ message.created_at }}
                        </p>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <input
                            id="btn-input"
                            type="text"
                            name="message"
                            class="form-control input-sm col-8"
                            placeholder="Сообщение..."
                            v-model="newMessage"
                            @keyup="sendTypingEvent">
                    <a class="ml-2 col-3 btn btn-outline-info" @click="sendMessage">
                        ✉️
                    </a>
                </div>
            </div>
            <span v-if="activeUser" class="text-muted"> {{ activeUser.name }} печатает...</span>
        </div>
        <div class="col-3">
            <p class="" v-for="(user, index) in users" :key="index">
                <img :src="'/svg/' + user.id + '.jpg'" width="55"
                class="img-thumbnail rounded-circle" alt="...">
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                allMessages: [],
                showEx: '',
                messages: [],
                newMessage: '',
                users: [],
                activeUser: false,
                typingTimer: false,
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
                .listen('MessageSent', (event, message) => {
                    this.messages.push(event.message);
                    this.messages = this.messages.filter(m => m.id != message.id);
                })
        },
        methods: {
            deleteButton(id) {
                if(this.showEx === '') {
                    this.showEx = id;
                }
                else {
                    this.showEx = '';
                }
            },
            fetchMessages() {
                axios.get('messages').then((response) => {
                    this.messages = response.data.slice(-5);
                    this.allMessages = response.data;
                });
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
            },
            sendMessage() {
                axios.post('/messages', {message: this.newMessage});
                this.newMessage = '';
                this.fetchMessages();
            },
            deleteMessage(messageId) {
                axios.get('/messageDelete/' + messageId);
                this.fetchMessages();
            },
            loadPreviousMessages() {
                axios.get('messages').then((response) => {
                    let k = this.messages.length;
                    k = k + 5;
                    this.messages = response.data.slice(-k);
                });
            }
        }
    };
</script>