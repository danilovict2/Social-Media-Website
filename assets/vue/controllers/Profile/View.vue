<template>
    <div class="w-[768px] mx-auto h-full overflow-auto">
        <div class="relative bg-white">
            <img src="https://www.prodraw.net/fb_cover/images/fb_cover_65.jpg" class="w-full h-[200px] object-cover">
            <div class="flex ">
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp"
                class="ml-[48px] w-[128px] h-[128px] -mt-[64px]">
                <div class="flex-1 p-3">
                    <h2 class="font-bold text-lg">{{ user.name }}</h2>
                </div>
            </div>
        </div>
        <div>
            <TabGroup>
                <TabList class="flex bg-white">
                    <Tab v-slot="{ selected }" as="template" v-if="isMyProfile">
                        <TabItem :selected="selected" text="About"></TabItem>
                    </Tab>
                    <Tab v-slot="{ selected }" as="template">
                        <TabItem :selected="selected" text="Posts"></TabItem>
                    </Tab>
                    <Tab v-slot="{ selected }" as="template">
                        <TabItem :selected="selected" text="Followers"></TabItem>
                    </Tab>
                    <Tab v-slot="{ selected }" as="template">
                        <TabItem :selected="selected" text="Followings"></TabItem>
                    </Tab>
                    <Tab v-slot="{ selected }" as="template">
                        <TabItem :selected="selected" text="Photos"></TabItem>
                    </Tab>
                </TabList>

                <TabPanels class="mt-2">
                    <TabPanel v-if="isMyProfile">
                        <Edit :status="status" :user="user" />
                    </TabPanel>

                    <TabPanel>
                        Follower Content
                    </TabPanel>
                </TabPanels>
            </TabGroup>
        </div>
    </div>
</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import TabItem from '../../components/TabItem.vue';
import Edit from './Edit.vue';
import { computed } from 'vue';

const isMyProfile = computed(() => props.authUser && props.authUser.id === props.user.id);

const props = defineProps({
    status: {
        type: String,
        default: 'a'
    },
    user: Object,
    authUser: {
        type: Object,
        required: false
    }
});
</script>