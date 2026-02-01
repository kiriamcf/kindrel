<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { TriangleAlert } from 'lucide-vue-next';
import { Organization } from '@/types';
import OrganizationAccess from '@/components/organization/OrganizationAccess.vue';
import Pagination from '@/components/Pagination.vue';

interface Props {
    organizations: {
        data: Organization[];
        links: Array<{ url: string | null; label: string; active: boolean }>;
    };
    requested: number[];
}

defineProps<Props>();
</script>

<template>
    <AppLayout>
        <div class="px-4 py-6">
            <template v-if="$page.props.auth.org === null">
                <Card class="mb-6">
                    <CardHeader>
                        <CardTitle class="flex justify-center gap-3">
                            <TriangleAlert class="size-4" />You are currently not a member of any organization
                        </CardTitle>
                        <CardDescription class="text-center">
                            In order to have access to the platform features, please request
                            access to an existing organization
                        </CardDescription>
                    </CardHeader>
                </Card>
            </template>
    
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <template v-for="organization in organizations.data" :key="organization.id">
                    <OrganizationAccess :organization :already-requested="requested.includes(organization.id)" />
                </template>
            </div>

            <Pagination :links="organizations.links" />
        </div>
    </AppLayout>
</template>