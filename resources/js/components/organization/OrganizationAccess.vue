<script setup lang="ts">
import Button from "@/components/ui/button/Button.vue";
import { getInitials } from '@/composables/useInitials';
import { computed } from 'vue';
import Avatar from '../ui/avatar/Avatar.vue';
import AvatarImage from '../ui/avatar/AvatarImage.vue';
import AvatarFallback from '../ui/avatar/AvatarFallback.vue';
import { Organization } from '@/types';
import Card from '../ui/card/Card.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import CardHeader from '../ui/card/CardHeader.vue';
import CardContent from '../ui/card/CardContent.vue';
import { router } from '@inertiajs/vue3';
import { requestAccess } from "@/routes/backoffice/organizations";

interface Props {
    organization: Organization;
    alreadyRequested?: boolean;
}

const props = defineProps<Props>();

const showAvatar = computed(
    () => false,
);

function request() {
    router.post(requestAccess({ slug: props.organization.slug }), {
        organization_id: props.organization.id,
    });
}
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="flex items-center gap-3">
                <Avatar class="size-12">
                    <AvatarImage v-if="showAvatar" :src="props.organization.avatar!" :alt="props.organization.name" />
                    <AvatarFallback class="rounded-lg text-black dark:text-white">
                        {{ getInitials(props.organization.name) }}
                    </AvatarFallback>
                </Avatar>
                {{ props.organization.name }}
            </CardTitle>
        </CardHeader>
        <CardContent class="grow flex flex-col justify-between">
            <p class="line-clamp-2">
                {{ props.organization.description }}
            </p>
            
            <div class="flex justify-end items-center gap-2 mt-4">
                <Button variant="ghost">
                    View
                </Button>
                <template v-if="props.alreadyRequested">
                    <Button variant="outline" disabled>
                        Requested
                    </Button>
                </template>
                <template v-else>
                    <Button @click="request" variant="secondary">
                        Request
                    </Button>
                </template>
            </div>
        </CardContent>
    </Card>
</template>