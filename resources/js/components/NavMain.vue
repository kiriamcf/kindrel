<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Lock } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{
    items: NavItem[];
}>();

const page = usePage();

const groupedItems = computed(() => {
    return props.items.reduce(
        (acc, item) => {
            const group = item.group || 'Platform';
            if (!acc[group]) acc[group] = [];
            acc[group].push(item);
            return acc;
        },
        {} as Record<string, NavItem[]>
    );
});
</script>

<template>
    <div v-for="(groupItems, groupName) in groupedItems" :key="groupName">
        <SidebarGroup class="px-2 py-0">
            <SidebarGroupLabel>{{ groupName }}</SidebarGroupLabel>
            <SidebarMenu>
                <SidebarMenuItem v-for="item in groupItems" :key="item.title">
                    <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(item.href, page.url)"
                        :tooltip="item.title"
                    >
                        <button disabled v-if="item.disabled">
                            <component :is="item.icon" />
                            <span>{{ item.title }}</span>
                            <Lock class="ml-auto" />
                        </button>

                        <Link :href="item.href" v-else>
                            <component :is="item.icon" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarGroup>
    </div>
</template>
