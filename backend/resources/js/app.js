import './bootstrap'
import Vue from 'vue'
import ReviewLike from './components/ReviewLike'
import ReviewTagsInput from './components/ReviewTagsInput'

const app = new Vue({
    el: '#app',
    components: {
        ReviewLike,
        ReviewTagsInput,
    }
})
