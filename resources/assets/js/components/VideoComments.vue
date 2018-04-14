<template>
  <div>

  
<p>{{pluralizeComment(comments.length) }}</p>

<div class="video-comment clearfix" v-if="signedIn" >
<textarea placeholder="Say something" class="form-control video-comment__input" v-model="body">
 
</textarea>
<div class="pull-right">
  <button type="submit" class="btn btn-outline-green btn-sm" @click.prevent="createComment">Post</button>
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
 <span v-text="ago(comment.created_at.date)"></span>
<p>{{comment.body}}</p>
  
  <ul class="list-inline" style="margin-bottom:10px; margin-top:-20px;" >
    <li v-if="signedIn">
      <a href="#" @click.prevent="toggleReplyForm(comment.id)">{{replyFormVisible === comment.id ? 'Cancel' : 'Reply'}}</a>
    </li>
  </ul>

 <div class="video-comment" v-if="replyFormVisible === comment.id" >
   <textarea class="form-control" v-model="replyBody"></textarea>
   <div class="pull-right" style="margin-bottom:10px;">
     <button class="btn btn-blue btn-sm " type="submit" @click.prevent="createReply(comment.id)">Reply</button>
      </div>
 </div>
<div class="media" v-for="reply in comment.replies.data">
    <div class="media-left">
            <a :href="'/channel/'+reply.channel.data.slug">
            <img :src="reply.channel.data.image" class="media-object" :alt="comment.channel.data.image" >
            </a>
     </div>
     <div class="media-body">
         <a :href="'/channel/'+comment.channel.data.slug">{{comment.channel.data.name}}</a>
 <span v-text="ago(comment.created_at.date)"></span>
 <p>{{reply.body}}</p>
     </div>
</div> 
 

        </div> 
    </li>
</ul>
</div>
</template>
<script>
import moment from "moment";
export default {
  data() {
    return {
      comments: [],
      body: null,
      editing: false,
      replyBody: null,
      user: window.App.user,
      signedIn: window.App.signedIn,
      replyFormVisible: null
    };
  },
  props: {
    videoUid: null
  },
  methods: {
    toggleReplyForm(commentId) {
      this.replyBody = null;
      if (this.replyFormVisible === commentId) {
        this.replyFormVisible = null;
        return;
      }
      this.replyFormVisible = commentId;
    },
    createReply(commentId) {
      this.$http
        .post("/videos/" + this.videoUid + "/comments", {
          body: this.replyBody,
          reply_id: commentId
        })
        .then(
          response => {
            this.comments.map((comment, index) => {
              if (comment.id === commentId) {
                this.comments[index].replies.data.unshift(response.data.data);
              }
            });
            this.replyBody = null;
            this.replyFormVisible = null;

            flash("Your reply successfully added");
          },
          () => {
            flash("Something went wrong", "danger");
          }
        );
    },
    createComment() {
      this.$http
        .post("/videos/" + this.videoUid + "/comments", {
          body: this.body
        })
        .then(
          response => {
            this.comments.unshift(response.data.data);
            this.body = null;
            flash("Your reply successfully added");
          },
          () => {
            flash("Something went wrong", "danger");
          }
        );
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
    },
    ago(value) {
      return (
        moment(value)
          .subtract(120, "minutes")
          .from(moment()) + "..."
      );
    }
  },
  mounted() {
    this.getComments();
  }
};
</script>
