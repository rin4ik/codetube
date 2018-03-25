<script>
    export default {
        data() {
            return {
                isVisible: !! window.App.user,
            }
        },

        mounted() {
            if (! window.App.user) {
                this.$modal.show('login');
            }
        }
    }
</script>
