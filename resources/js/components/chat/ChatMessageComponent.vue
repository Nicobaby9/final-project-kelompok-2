<template>
    <div class="chat-lists">
        <div class="messages" v-for="chat in chats">
            <div class="users">
                {{ chat.user.name }} <span class="time"> {{chat.created_at}} </span>
            </div>
            <div class="message">
                <p>{{ chat.subject }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import BusEvent from '../bus.js'

    export default {
        data() {
            return {
                chats: []
            }
        },
        mounted() {
            this.getChats();
            BusEvent.$on('chat.sent', (newChat) => {
                this.chats.push(newChat);
                this.scrollToBottom();
            });
        }, 
        methods: {
            getChats() {
                axios.get('/chat/all-chats').then(response => {
                    this.chats = response.data.reverse();
                    this.scrollToBottom();
                });
            },
            scrollToBottom() {
                setTimeout(function() {
                    let chatList = document.getElementsByClassName('chat-lists')[0];
                chatList.scrollTop = chatList.scrollHeight
                }, 1)
            }, 
        }

    }
</script>

<style lang="scss"> 
    .messages{
        margin-top:11px;
        .users{
            font-weight:bold;
            font-size: 20px;
            color: blue;
        }
        .time{
            font-size:10px;
            color: black;
        }
        .message{
            font-size: 1.1rem;
            margin-left: 10px;
            border-radius: 10px;
            -webkit-box-flex: initial;
            flex: initial;
            display: table;

            p{
                margin: 3px 3px 3px 10px;
                font-size: 16px;
            }
        }
    }

    .chat-lists {
        max-height: 470px;
        overflow-y: scroll;
    }
</style>
