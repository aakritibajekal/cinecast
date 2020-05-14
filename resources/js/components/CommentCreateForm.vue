<template>
  <form :action="submissionUrl" method="POST">
    <slot></slot>

    <div v-if="isGif" class="row">
      <div class="col-md-12">
        <img :src="content" />
        <button type="button" class="btn" @click="updateMessage">Update Comment</button>
        <input type="hidden" name="post_id" :value="postId" />
        <input type="hidden" name="parent_id" :value="commentId" />
        <input type="hidden" name="content" v-model="content" />
        <input type="hidden" name="is_gif" :value="isGif" />
      </div>
    </div> 

    <div v-else class="row">
      <div class="col-md-12">
        <div class="form-group">
          <strong>New Comment</strong>
                <input type="text" name="content"  class="form-control" v-model="content" />
              <input type="hidden" name="post_id" :value="postId"  />
        <input type="hidden" name="parent_id" :value="commentId" />
    
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <input type="submit" class="btn btn-success" value="Create Comment" />
      </div>
    </div>
  </form>
</template>


<script>
export default {
  name: "comment-create-form",
  props: ["submissionUrl", "postId", "commentId"],
  computed: {
    content: {
      get() {
        this.isStringAGIFUrl(this.$attrs.value);
        return this.$attrs.value;
      },
      set(value) {
        this.$emit("input", value); 
      }
    }
  },
  methods: {
    isStringAGIFUrl(string) {
      if (string.includes("http") && string.includes(".gif")) {
        this.isGif = true;
        return true;
      }else
      this.isGif = false;
      return false;
    },
    updateMessage() {
      this.content = "";
    }
  },
  data() {
    return {
      isGif: false
    };
  }
};
</script>

