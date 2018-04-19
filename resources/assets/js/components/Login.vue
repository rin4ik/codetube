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
          this.feedback = error.response.data.errors;
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