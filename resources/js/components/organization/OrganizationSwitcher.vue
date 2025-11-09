<script setup lang="ts">
import { Organization } from '@/types';

const props = defineProps<{
    current?: Organization;
}>();
</script>

<template>
    <div>
        <span v-if="props.current">{{ props.current.name }}</span>
    </div>
</template>
