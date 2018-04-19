<template>
  <div>  
<div  v-if="subscribers !== null">
   {{pluralizeComment(subscribers) }}    &nbsp; <button v-if="canSubscribe" class="btn  small  light-green" @click.prevent="handle" type="button">{{userSubscribed ? 'Unsubscribe':'Subscribe'}}</button>
</div>

  </div>
</template>

<script>
export default {
  props: { channelSlug: null },
  data() {
    return {
      subscribers: null,
      userSubscribed: false,
      canSubscribe: false
    };
  },
  methods: {
    getSubscriptionStatus() {
      this.$http.get("/subscriptions/" + this.channelSlug).then(response => {
        this.subscribers = response.data.data.count;
        this.userSubscribed = response.data.data.user_subscribed;
        this.canSubscribe = response.data.data.can_subscribe;
      });
    },
    pluralizeComment(count) {
      if (count === 1) {
        return count + " subscribe";
      } else {
        return count + " subscribers";
      }
    },
    handle() {
      if (this.userSubscribed) {
        this.unsubscribe();
      } else {
        this.subscribe();
      }
    },
    subscribe() {
      this.userSubscribed = true;
      this.subscribers++;
      this.$http.post("/subscription/" + this.channelSlug).then(response => {
        flash("Subscribed");
      });
    },
    unsubscribe() {
      this.userSubscribed = false;
      this.subscribers--;
      this.$http.delete("/subscription/" + this.channelSlug).then(response => {
        flash("Unsubscribed", "danger");
      });
    }
  },
  mounted() {
    this.getSubscriptionStatus();
  }
};
</script>
<style scoped>

</style>
