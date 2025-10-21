<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { TriangleAlert } from 'lucide-vue-next';
</script>

<template>
    <AppLayout>
        <div class="p-4" v-if="$page.props.auth.org === null">
            <Card>
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
        </div>
    </AppLayout>
</template>