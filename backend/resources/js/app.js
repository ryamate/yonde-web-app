import './bootstrap'
import Vue from 'vue'
import ReviewLike from './components/ReviewLike'
import ReviewTagsInput from './components/ReviewTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
    el: '#app',
    components: {
        ReviewLike,
        ReviewTagsInput,
        FollowButton,
    }
})
