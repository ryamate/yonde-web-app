import './bootstrap'
import Vue from 'vue'
import ReviewLike from './components/ReviewLike'
import ReadRecordTagsInput from './components/ReadRecordTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
    el: '#app',
    components: {
        ReviewLike,
        ReadRecordTagsInput,
        FollowButton,
    }
})
