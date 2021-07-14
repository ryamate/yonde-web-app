<template>
  <span class="d-flex align-items-center">
    <button type="button" class="btn m-0 p-0 shadow-none">
      <span class="fa-stack">
        <i class="fas fa-circle fa-stack-2x"
          :class="{'text-teal1 text-shadow':this.isLikedBy,
          'text-light':!this.isLikedBy}"
          @click="clickLike"></i>
        <i class="far fa-thumbs-up fa-stack-1x"
          :class="{'text-white':this.isLikedBy,
          'text-secondary':!this.isLikedBy,
          'heart particleLayer explosion LikesIcon-fa-heart':this.gotToLike}"
          @click="clickLike"></i>
      </span>
    </button>
    {{ countLikes }}
  </span>
</template>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
        gotToLike: false,
      }
    },
    methods: {
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true
        this.countLikes = response.data.countLikes
        this.gotToLike = true
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
        this.gotToLike = false
      },
    },
  }
</script>
