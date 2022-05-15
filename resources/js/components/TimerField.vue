<template>
  <div class="flex items-center space-x-2 tabular-nums">
    <button type="button" @click="toggle">
      <svg
        v-if="!current.from || (current.from && current.to)"
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
        />
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
      <svg
        v-if="current.from && !current.to"
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        />
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"
        />
      </svg>
    </button>
    <div
      class="text-sm text-gray-700 dark:text-gray-400"
      v-if="current.from && !current.to"
    >
      {{ elapsed }}
    </div>
    <div
      class="text-sm text-gray-700 dark:text-gray-400"
      v-else-if="current.from && current.to"
    >
      {{ moment.unix(current.from).format('HH:mm:ss') }} - {{ moment.unix(current.to).format('HH:mm:ss') }}
    </div>
  </div>
</template>

<script lang="ts" setup>
import moment from "moment";
import { computed, ref, onMounted } from "vue";
import { useField } from "taskday";

const { state, onChange } = useField();
const elapsed = ref('00:00:00');

const current = computed(() => {
  return (() => {
    try {
      return JSON.parse(state.value);
    } catch {
      return {
        from: null,
        to: null,
      };
    }
  })();
});

onMounted(() => { 
  setInterval(() => {
    var duration = moment.duration(moment(current.value.from).fromNow());

    if(!duration.isValid()) {
      return ;
    }

    console.log(duration);

    var hours = duration.hours() >= 10 ? duration.hours() : "0" + duration.hours();
    var minutes = duration.minutes() >= 10 ? duration.minutes() : "0" + duration.minutes();
    var seconds = duration.seconds() >= 10 ? duration.seconds() : "0" + duration.seconds();

    elapsed.value = `${hours}:${minutes}:${seconds}`;
  }, 1000)
})

function toggle() {
  state.value = current.value;

  if (state.value.from && !state.value.to) {
    state.value.to = moment().unix();
  } else if (!state.value.from && !state.value.to) {
    state.value.from = moment().unix();
  } else {
    if (confirm("Reset timer?")) {
      state.value.from = null;
      state.value.to = null;
    }
  }
  
  console.log('saving:', state.value);

  state.value = JSON.stringify(state.value);

  onChange();
}
</script>
