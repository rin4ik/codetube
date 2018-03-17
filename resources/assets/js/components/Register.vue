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
      feedback: ""
    };
  },
  methods: {
    register() {
      axios
        .post("/register", this.form)
        .then(response => {
          location.reload();
        })
        .catch(error => {
          this.feedback = error.response.data.errors;
        });
    }
  }
};
</script>
