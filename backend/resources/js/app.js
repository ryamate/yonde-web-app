import './bootstrap'
import 'infinite-scroll'
import Vue from 'vue'
import ReviewLike from './components/ReviewLike'
import ReadRecordTagsInput from './components/ReadRecordTagsInput'
import ChildTagsInput from './components/ChildTagsInput'
import BookshelfTagsInput from './components/BookshelfTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
    el: '#app',
    components: {
        ReviewLike,
        ReadRecordTagsInput,
        ChildTagsInput,
        BookshelfTagsInput,
        FollowButton,
    }
})
