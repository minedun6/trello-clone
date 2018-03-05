<script>
    import axios from 'axios'

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
            loadMembers() {
                this.$store.dispatch('fetchMembers')
            },
            toggleChosenMember(key, member) {
                if (this.selectedMembers.includes(member)) {
                    this.selectedMembers.splice(key, 1);
                } else {
                    this.selectedMembers.push(member);
                }
            },
            setStory(event) {
                this.story = event.params.story
            },
            affectMembersToStory() {
                // replace with store method
                axios.post(`/stories/${this.story.id}/members`, {members: this.selectedMembers})
                    .then(res => {
                        console.log(res)
                    }).catch(err => {
                    console.log(err)
                })
            },
            isMemberChosen(member) {
                return this.selectedMembers.includes(member) ? 'member-chosen' : '';
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