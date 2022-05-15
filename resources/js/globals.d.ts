import { defineComponent } from "vue";

declare global {
  interface Taskday {
    fields: Record<string, ReturnType<typeof defineComponent>>
    filters: Record<string, ReturnType<typeof defineComponent>>
    options: Record<string, ReturnType<typeof defineComponent>>
    registerField(namespace: string, component: ReturnType<typeof defineComponent>): void
    registerFilter(namespace: string, component: ReturnType<typeof defineComponent>): void
    registerOptions(namespace: string, component: ReturnType<typeof defineComponent>): void
    register(namespace: string, component: {
        field: ReturnType<typeof defineComponent>,
        filter?: ReturnType<typeof defineComponent>,
        options?: ReturnType<typeof defineComponent>
        views?: {id: string, name: string, component: ReturnType<typeof defineComponent>}[]
        widgets?: {id: string, name: string, component: ReturnType<typeof defineComponent>}[]
    }): void
  }

  let taskday : Taskday;
}
