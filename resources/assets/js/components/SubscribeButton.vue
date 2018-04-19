<template>
  <div>  
<div  v-if="subscribers !== null">
   {{pluralizeComment(subscribers) }}    &nbsp; <button v-if="canSubscribe" class="btn  small  light-green" type="button">{{userSubscribed ? 'Unsubscribe':'Subscribe'}}</button>
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
      console.log(count);
      if (count === 1) {
        return count + " subscribe";
      } else {
        return count + " subscribers";
      }
    }
  },
  mounted() {
    this.getSubscriptionStatus();
  }
};
</script>
<style scoped>

</style>
