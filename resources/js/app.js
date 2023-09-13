import './bootstrap';
import Alpine from 'alpinejs'
import Tooltip from "@ryangjchandler/alpine-tooltip";
import axios from 'axios';
import * as echarts from 'echarts';
import googleCalendarPlugin from '@fullcalendar/google-calendar';
import dayGridPlugin from '@fullcalendar/daygrid';
import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import preline from 'preline'

Alpine.plugin(Tooltip);
// window.Alpine = Alpine
// Alpine.start()
window.axios = axios
window.preline = preline
window.echarts = echarts
window.googleCalendarPlugin = googleCalendarPlugin
window.dayGridPlugin = dayGridPlugin
window.Calendar = Calendar
window.timeGridPlugin = timeGridPlugin

