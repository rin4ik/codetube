<template>
  <video
   id="video"
    class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9"
    controls preload="auto"
     data-setup='{"fluid":true, "preload":auto}'
     :poster="thumbnailUrl" >
        <source type="video/mp4" :src="videoUrl"></source>
  </video>

</template>
<script>
import videojs from "video.js";
export default {
  props: {
    videoUid: null,
    videoUrl: null,
    thumbnailUrl: null
  },
  data() {
    return {
      player: null
    };
  },

  mounted() {
    this.player = videojs("video");
  }
};
</script>
