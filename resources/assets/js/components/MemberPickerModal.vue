<script>
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
                    this.selectedMembers.splice(key ,1);
                } else {
                    this.selectedMembers.push(member);
                }

            },
            isMemberChosen(member) {
                return this.selectedMembers.includes(member) ? 'member-chosen' : '';
            }
        }
    }
</script>

<style scoped>

</style>