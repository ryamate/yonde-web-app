<template>
  <span class="d-flex align-items-center">
    <button type="button" class="btn m-0 p-0 shadow-none">
      <span class="fa-stack fa-lg">
        <i class="fas fa-circle fa-stack-2x"
          :class="{'text-paper text-shadow':this.isFollowedBy,
          'text-light':!this.isFollowedBy}"
          @click="clickFollow"></i>
        <i class="fa-star fa-stack-1x"
          :class="{'fas text-lemon-tea':this.isFollowedBy,
          'far text-secondary':!this.isFollowedBy,
          'heart particleLayer explosion LikesIcon-fa-heart':this.gotToFollow}"
          @click="clickFollow"></i>
      </span>
    </button>
  </span>
</template>

<script>
  export default {
    props: {
      initialIsFollowedBy: {
        type: Boolean,
        default: false,
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
        isFollowedBy: this.initialIsFollowedBy,
        gotToFollow: false,
      }
    },
    methods: {
      clickFollow() {
        if (!this.authorized) {
          alert('フォロー機能はログイン中のみ使用できます')
          return
        }

        this.isFollowedBy
          ? this.unfollow()
          : this.follow()
      },
      async follow() {
        const response = await axios.put(this.endpoint)

        this.isFollowedBy = true
        this.gotToFollow = true
      },
      async unfollow() {
        const response = await axios.delete(this.endpoint)

        this.isFollowedBy = false
        this.gotToFollow = false
      },
    },
  }
</script>
