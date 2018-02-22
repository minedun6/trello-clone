<script>
    export default {
        data() {
            return {
                selectedMembers: []
            }
        },
        computed: {
            members() {
                return this.$store.getters.members;
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

                console.log(this.selectedMembers)
            },
            isMemberChosen(member) {
                console.log(this.selectedMembers.includes(member));
                return this.selectedMembers.includes(member) ? 'member-chose' : '';
            }
        }
    }
</script>

<style scoped>

</style>