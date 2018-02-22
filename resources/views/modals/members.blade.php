<member-picker-modal inline-template>
    <modal name="members" width="500" height="auto" @opened="loadMembers" @before-open="setStory">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg p-6">Select Assignees to this task</p>
            <button class="pr-6" @click="$modal.hide('members')">x</button>
        </div>
        <form class="p-4">
            <div class="flex flex-col">
                <div class="relative my-2">
                    <input type="text" class="form-control search w-full pl-3" v-model="query"
                           placeholder="Search for members ...">
                    <div class="absolute pin-y pin-l pl-3 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h5 w-5">
                            <path class="fill-current text-grey h-4 w-4"
                                  d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                        </svg>
                    </div>
                    <div class="absolute pin-y pin-r pr-3 flex items-center justify-center cursor-pointer"
                         v-if="query.length > 0" @click="query = ''">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h5 w-5" >
                            <path class="fill-current text-grey"
                                  d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="h-2" v-show="query.length > 0">
                <em class="text-sm text-grey">Displaying results @{{ filteredMembers.length }} / @{{ members.length
                    }}</em>
            </div>
        </form>
        <div class="p-1 m-2 overflow-y-scroll">
            <ul class="list-reset h-48">
                <li v-for="(member, key) in filteredMembers"
                    class="flex p-2 justify-between items-center cursor-pointer rounded mb-1"
                    :class="isMemberChosen(member)"
                    @click="toggleChosenMember(key, member)"
                    :key="key">
                    <p>@{{ member.name }}</p>
                    <img class="rounded-full mr-1" src="/img/user.svg" width="30" height="30"/>
                </li>
            </ul>
        </div>
        <div class="flex justify-end bg-grey-lighter py-2 items-center">
            <a href="#" class="no-underline text-grey-darker text-grey-darkest mr-6"
               @click.prevent="$modal.hide('members')">
                Cancel
            </a>
            <button type="submit" class="btn py-2 px-3 bg-blue rounded text-white mr-4" @click.prevent="affectMembersToStory">
                Save
            </button>
        </div>
    </modal>
</member-picker-modal>