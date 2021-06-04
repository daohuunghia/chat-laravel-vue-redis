<template>
    <div class="message">
        <div class="message-item user-name" :class="{'is-current-user': $root.currentUserLogin.id === message.user.id}">
           <strong>{{ message.user.name }}</strong>
        </div>
        <div class="message-item timestamp">
            | {{ message.created_at | formatDate }}:
        </div>
        <div class="message-item text-message text-success">
            {{ message.message }}
        </div>
    </div>
</template>
<script>
import moment from 'moment'
export default {
    filters: {
        formatDate (value) {
            if (value) {
                return moment(String(value)).format('DD/MM/YYYY hh:mm:ss')
            }
        }
    },
    props: {
        message: {
            type: Object,
            default: {}
        }
    },
    created() {
    }
}
</script>
<style lang="scss" scoped>
.message {
    display: flex;
    color: #00b8ff;
    .message-item:not(:last-child) {
        margin-right: 5px;
    }
}
.message:not(:last-child) {
    padding-bottom: 20px;
}
.is-current-user {
    color: #a900ff;
}
</style>
