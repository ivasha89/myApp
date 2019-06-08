<template>
    <div class="input-group">

    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                newMessage: '',
            }
        },
        methods: {
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage});
                axios.post('/messages', {message: this.message});
                this.newMessage = ''
            }
        }
    }
</script>