
  <template>
        <div>
          <a @click="show"   class="btn btn-outline-default btn-sm ">Edit</a>
          <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated shake" mode="out-in" appear>


          <modal name="update"    >
            <input id="name" type="text" class="form-control" name="name"           v-model="video.title" required autofocus>
  
                  </modal>
                  </transition>
        </div>
        
  </template>

  <script>
export default {
  props: ["video"],
  data() {
    return {
      feedback: "",
      loading: false
    };
  },
  methods: {
    show() {
      this.$modal.show("update");
    }
  }
};
</script>