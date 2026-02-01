<script setup lang="ts">
import {
  ToastRoot,
  ToastTitle,
  ToastDescription,
  ToastClose,
} from '@/components/ui/toast'
import { cn } from '@/lib/utils'

const props = defineProps<{
  title?: string
  description?: string
  class?: string
}>()
</script>

<template>
  	<ToastRoot
    	:class="cn(
      		'relative flex w-full gap-3 rounded-md border bg-background p-4 shadow-lg',
      		props.class,
    	)"
  	>
    	<div class="flex flex-col gap-1">
      		<ToastTitle
        		v-if="props.title"
        		class="text-sm font-semibold"
      		>
        		{{ props.title }}
      		</ToastTitle>

        	<ToastDescription
          		v-if="props.description"
          		class="text-sm text-muted-foreground"
        	>
          		{{ props.description }}
        	</ToastDescription>
      	</div>

      	<ToastClose
        	class="absolute right-2 top-2 rounded-md p-1 text-muted-foreground hover:text-foreground"
      	/>
    </ToastRoot>
</template>
