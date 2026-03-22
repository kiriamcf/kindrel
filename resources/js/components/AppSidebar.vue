<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes/backoffice';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutGrid, KeyRound, IdCardLanyard, FingerprintPattern } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { list } from '@/routes/backoffice/organizations';
import { show as manageRequests } from '@/actions/App/Http/Controllers/Web/Backoffice/OrganizationUserRequestController';
import { index as manageUsers } from '@/actions/App/Http/Controllers/Web/Backoffice/OrganizationUserController';

const page = usePage();

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Request Access',
        href: list(),
        icon: KeyRound,
    },
    {
        title: 'Manage Requests',
        href: page.props.auth.org ? manageRequests(page.props.auth.org) : list(),
        icon: FingerprintPattern,
        disabled: page.props.auth.org === null,
        group: 'Organization',
    },
    {
        title: 'Manage Users',
        href: page.props.auth.org ? manageUsers(page.props.auth.org) : list(),
        icon: IdCardLanyard,
        disabled: page.props.auth.org === null,
        group: 'Organization',
    },
];

const footerNavItems: NavItem[] = [
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
