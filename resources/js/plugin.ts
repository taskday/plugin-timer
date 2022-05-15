import TimerField from './components/TimerField.vue';

document.addEventListener('taskday:init', () => {
  taskday.register('timer', {
    field: TimerField
  });
})

