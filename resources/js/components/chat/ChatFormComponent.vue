<template>
    <div>
        <form>
            <div class="form-action">
                <textarea placeholder="isi chat anda" class="form-control chatForm" rows="2" v-model="body" @keydown="handleInput"> 
                	
                </textarea>
            </div>
        </form>
    </div>
</template>

<script>
import Moment from 'moment'
import BusEvent from '../bus.js'
    export default {
        data() {
            return {
                body: '',
            }
        },
        mounted() {},

        methods: {
            handleInput(e) {
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    this.submit();
                }
            },
            submit() {
                let bodyInput = this.body.trim();

                if (bodyInput === '') {
                    return
                }

                let newChat = {
                    subject: bodyInput,
                    created_at: Moment().utc(0).format('DD HH:mm'),
                    user: {
                        name : Laravel.user.name   
                    }
                }

                axios.post('/chat/new', {subject : bodyInput}).then(response => {
                    BusEvent.$emit('chat.sent', newChat);
                    this.body = ''
                })

                
            }
        }
    }
</script>

<style lang="scss">
	.chatForm{
		border: solid 1px black;
		margin-top: 20px;
	}
</style>