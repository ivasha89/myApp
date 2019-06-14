<template>
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">Чат</div>
                <div class="card-body" style="height: 300px; overflow-y:scroll" v-chat-scroll="{always: false}"
                     @scroll-top="loadPreviousMessages()">
                    <div class="shadow text-center rounded" v-if="messages.length < allMessages.length" @click.prevent="loadPreviousMessages()">
                        Предыдущие сообщения
                    </div>
                    <div class="rounded p-2 m-1" style="background-color: lightblue"
                         v-for="(message, index) in messages" :key="index">
                        <div class="clearfix">
                            <strong class="text-left">
                                {{ message.user.name }}
                            </strong>
                            <span class="text-left">
                                :
                            </span>
                            <a class="mb-1 text-muted text-left">
                                {{ message.created_at }}
                            </a>
                            <a class="float-right btn dropdown-toggle" id="mark" type="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"
                               v-if="message.user_id === user.id">
                                ...
                            </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mark">
                                    <a class="dropdown-item" @click="deleteMessage(message.id)">
                                        Удалить
                                    </a>
                                </div>
                        </div>
                        <div class="text-break">
                            {{ message.message }}
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex clearfix">
                    <input
                            role="textbox"
                            id="btn-input"
                            aria-multiline="true"
                            contenteditable="true"
                            name="message"
                            class="form-control input-sm"
                            placeholder="Сообщение..."
                            v-model="newMessage"
                            @keyup="sendTypingEvent()"
                            rows="2">
                    <a class="ml-1 btn btn-outline-info" @click.prevent="sendMessage()">
                        ✉️
                    </a>
                </div>
            </div>
            <span v-if="activeUser" class="text-muted"> {{ activeUser.name }} перебирает буковки...</span>
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
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                })
        },
        methods: {
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data.slice(-5);
                    this.allMessages = response.data;
                });
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
            },
            sendMessage() {
                axios.post('/messages', {message: this.newMessage})
                    .then(responce => {
                        this.fetchMessages();
                            this.newMessage = ''
                    });
            },
            deleteMessage(messageId) {
                axios.get('/messageDelete/' + messageId)
                    .then(responce => {
                        this.fetchMessages()
                });
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