<script>
    import axios from 'axios'
    import _ from 'underscore'

    export default {
        data() {
            return {
                query: '',
                selectedMembers: [],
                tags: []
            }
        },
        computed: {
            members() {
                return this.$store.getters.members;
            },
            filteredMembers() {
                return this.members.filter(member => member.name.toLowerCase().includes(this.query.toLowerCase()))
            }
        },
        methods: {
            toggleChosenMember(key, member) {
                if (_.pluck(this.selectedMembers, 'id').includes(member.id)) {
                    let index = _.pluck(this.selectedMembers, 'id').indexOf(member.id);
                    this.selectedMembers.splice(index, 1);
                } else {
                    this.selectedMembers.push(member);
                }
            },
            handleBeforeOpenModal(event) {
                this.selectedMembers = []
                this.$store.dispatch('enableLoading', true)

                this.story = event.params.story
                this.story.members.forEach((m) => {
                    this.selectedMembers.push(m)
                })
            },
            handleAfterOpenModal(event) {
                setTimeout(() => {
                    this.$store.dispatch('enableLoading', false)
                }, 500)
            },
            affectMembersToStory() {
                // replace with store method
                // this.$store.dispatch('affectMembersToStory', )
                axios.post(`/stories/${this.story.id}/members`, {members: this.selectedMembers})
                    .then(res => {
                        if (res.data.success) {
                            this.$modal.hide('members')
                            this.story.members = res.data.members
                        }
                    }).catch(err => {
                    console.log(err)
                })
            },
            isMemberChosen(member) {
                return _.pluck(this.selectedMembers, 'id').includes(member.id) ? 'member-chosen' : '';
            }
        },
        filters: {
            highlight: function (words) {
                var iQuery = new RegExp(this.query, "ig");
                return words.toString().replace(iQuery, function (matchedTxt, a, b) {
                    return ('<mark>' + matchedTxt + '</mark>');
                });
            }
        }
    }
</script>

<style scoped>

</style>