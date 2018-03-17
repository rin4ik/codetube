<script>
export default {
  data() {
    return {
      feedback: "",
      form: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    login() {
      axios
        .post("/login", this.form)
        .then(() => location.reload())
        .catch(error => {
          this.feedback = error.response.data.message;
        });
    }
  }
};
</script>
