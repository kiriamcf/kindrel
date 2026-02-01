import { reactive } from 'vue'

export interface Toast {
    id: number
    title?: string
    description?: string
    duration?: number
}

const state = reactive<{ toasts: Toast[] }>({
  toasts: [],
})

let id = 0

export function useToast() {
    function toast(data: Omit<Toast, 'id'>) {
        const toastId = ++id
        state.toasts.push({ id: toastId, ...data })

        if (data.duration !== 0) {
            setTimeout(() => dismiss(toastId), data.duration ?? 4000)
        }
    }

    function dismiss(toastId: number) {
        const index = state.toasts.findIndex(t => t.id === toastId)
        if (index > -1) {
            state.toasts.splice(index, 1)
        }
    }

    return {
        toasts: state.toasts,
        toast,
        dismiss,
  }
}
