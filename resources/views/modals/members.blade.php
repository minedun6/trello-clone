<member-picker-modal inline-template>
    <modal name="members" width="350" height="400" @opened="loadMembers">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg p-6">Select Assignees to this task</p>
            <button class="pr-6" @click="$modal.hide('members')">x</button>
        </div>
        <form class="p-6" @submit.prevent>
            <div>
                <div class="relative my-2">
                    <input type="text" class="form-control search w-full pl-3" id="name"
                           placeholder="Search for members ...">
                    <div class="absolute pin-l pin-t mt-3 ml-2">
                        <font-awesome-icon icon="search" size="lg" class="text-grey"></font-awesome-icon>
                    </div>
                </div>
            </div>
        </form>
        <div class="p-1 m-2 overflow-y-scroll h-40">
            <ul class="list-reset mb-1">
                <li v-for="(member, key) in members"
                    class="flex p-2 justify-between items-center cursor-pointer rounded"
                    :class="isMemberChosen(member)"
                    @click="toggleChosenMember(key, member)"
                    :key="key">
                    <p>@{{ member.name }}</p>
                    <img class="rounded-full mr-1" src="/img/user.svg" width="30" height="30" />
                </li>
            </ul>
        </div>
        <div class="flex justify-end bg-grey-lighter py-2 items-center">
            <a href="#" class="no-underline text-grey mr-4" @click.prevent="$modal.hide('members')">
                Cancel
            </a>
            <button type="submit" class="btn py-2 px-3 bg-blue rounded text-white mr-2">
                Save
            </button>
        </div>
    </modal>
</member-picker-modal>