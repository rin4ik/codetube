<template>
 <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated fadeOutRightBig" mode="out-in" appear>

    <div class="alert alert-flash" :class="'alert-'+level" role="alert" style="padding-right:20px; padding-left:20px" v-show="show" v-text="body">
    
</div>
</transition>
</template>

<script>
export default {
  props: ["message", "levels"],
  data() {
    return {
      body: this.message,
      level: this.levels,
      show: false
    };
  },
  created() {
    if (this.message) {
      this.flash();
    }
    window.events.$on("flash", data => this.flash(data));
  },
  methods: {
    flash(data) {
      if (data) {
        this.body = data.message;
        this.level = data.level;
      }
      this.show = true;
      this.hide();
    },
    hide() {
      setTimeout(() => {
        this.show = false;
      }, 4000);
    }
  }
};
</script>
<style>
.alert-flash {
  position: fixed;
  right: 25px;
  bottom: 25px;
}
</style>