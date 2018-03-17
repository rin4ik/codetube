<script>
export default {
  data() {
    return {
      form: {
        name: "",
        channel_name: "",
        username: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      loading: false,
      feedback: ""
    };
  },
  methods: {
    register() {
      this.loading = true;
      axios
        .post("/register", this.form)
        .then(response => {
          location.reload();
        })
        .catch(error => {
          this.feedback = error.response.data.errors;
          this.loading = false;
        });
    }
  }
};
</script>
