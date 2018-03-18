<script>
export default {
  props: ["video"],
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
    edit() {
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