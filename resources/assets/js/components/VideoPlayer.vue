<template>
  <video
   id="video"
    class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9"
    controls preload="auto"
     data-setup='{"fluid":true,"playbackRates": [0.5, 1, 1.5, 2,2.5] }'
     :poster="thumbnailUrl">
        <source type="video/mp4" :src="videoUrl"></source>
  </video>

</template>
<script>
import videojs from "video.js";
import hotkeys from "videojs-hotkeys";
export default {
  props: {
    videoUid: null,
    videoUrl: null,
    thumbnailUrl: null
  },
  data() {
    return {
      player: null,
      duration: null
    };
  },
  methods: {
    hasHitQuotaView() {
      if (!this.duration) {
        return false;
      }
      return (
        Math.round(this.player.currentTime()) ===
        Math.round(10 * this.duration / 100)
      );
    }
  },
  mounted() {
    this.player = videojs("video");
    this.player.hotkeys({
      seekStep: 10,
      playbackRate: [0.5, 1, 1.5, 2, 2.5]
    });
    this.player.on("loadedmetadata", () => {
      this.duration = Math.round(this.player.duration());
    });
    setInterval(() => {
      if (this.hasHitQuotaView()) {
        console.log("log a view");
      }
    }, 1000);
  }
};
</script>
