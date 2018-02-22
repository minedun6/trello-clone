<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                query: '',
                selectedMembers: []
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
                axios.post(`/stories/${this.story.id}/members`, {
                    members: this.selectedMembers
                })
                    .then(res => {
                        console.log(res)
                    }).catch(err => {
                    console.log(err)
                })
            },
            isMemberChosen(member) {
                return this.selectedMembers.includes(member) ? 'member-chosen' : '';
            }
        }
    }
</script>

<style scoped>

</style>