<template>
  <div>

  
<p>{{pluralizeComment(comments.length) }}</p>

<div class="video-comment clearfix" v-if="signedIn" >
<textarea placeholder="Say something" class="form-control video-comment__input" v-model="body">
 
</textarea>
<div class="pull-right">
  <button type="submit" class="btn btn-outline-success btn-sm" @click.prevent="createComment">Post</button>
</div>
</div>

<ul class="media-list" style="padding:0; ">
    <li class="media" v-for="comment in comments">
        <div class="media-left">
            <a :href="'/channel/'+comment.channel.data.slug">
            <img :src="comment.channel.data.image" class="media-object" :alt="comment.channel.data.image" >
            </a>
        </div>
        <div class="media-body">
<a :href="'/channel/'+comment.channel.data.slug">{{comment.channel.data.name}}</a>
 {{comment.created_at.date}}  
<p>{{comment.body}}</p>
 
<div class="media" v-for="reply in comment.replies.data">
    <div class="media-left">
            <a :href="'/channel/'+reply.channel.data.slug">
            <img :src="reply.channel.data.image" class="media-object" :alt="comment.channel.data.image" >
            </a>
     </div>
     <div class="media-body">
         <a :href="'/channel/'+comment.channel.data.slug">{{comment.channel.data.name}}</a>
 {{comment.created_at.date}} 
 <p>{{reply.body}}</p>
     </div>
</div>
 

        </div>
    </li>
</ul>
</div>
</template>
<script>
export default {
  data() {
    return {
      comments: [],
      body: null,
      user: window.App.user,
      signedIn: window.App.signedIn
    };
  },
  props: {
    videoUid: null
  },
  methods: {
    createComment() {
      console.log("send request");
    },
    getComments() {
      this.$http
        .get("/videos/" + this.videoUid + "/comments")
        .then(response => {
          this.comments = response.data.data;
        });
    },
    pluralizeComment(count) {
      if (count === 1) {
        return count + " comment";
      } else {
        return count + " comments";
      }
    }
  },

  mounted() {
    this.getComments();
  }
};
</script>
