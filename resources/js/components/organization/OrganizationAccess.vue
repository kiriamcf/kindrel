<script setup lang="ts">
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

interface Props {
    organization: Organization;
}

const props = defineProps<Props>();

const showAvatar = computed(
    () => false,
);
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
            <CardContent>
                {{ props.organization.email }}
            </CardContent>
        </CardHeader>
    </Card>
</template>