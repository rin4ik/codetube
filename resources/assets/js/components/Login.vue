<script>
export default {
  data() {
    return {
      feedback: "",
      form: {
        email: "",
        password: ""
      },
      loading: false
    };
  },
  methods: {
    login() {
      this.loading = true;

      axios
        .post("/login", this.form)
        .then(() => location.reload())
        .catch(error => {
          this.feedback = error.response.data.message;
          this.loading = false;
        });
    },
    register() {
      this.$modal.hide("login");
      this.$modal.show("register");
    }
  }
};
</script>
<style scope>
.slide-enter-active {
  animation: slide-in 500ms ease-out forwards;
}
.slide-leave-active {
  animation: slide-out 500ms ease-out forwards;
}
@keyframes slide-in {
  from {
    transform: translateY(-30px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
@keyframes slide-out {
  from {
    transform: translateY(0px);
    opacity: 1;
  }
  to {
    transform: translateY(-30px);
    opacity: 0;
  }
}
</style>
