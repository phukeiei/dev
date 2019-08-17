<div class="main main-raised">

    <div class="section">
        <div class="container">
            <div class="title" id="use-controller">
                <h2>การใช้ Controllers</h2>
            </div>
            <div class="cd-section">
                <!--            <div class="title">-->
                <!--                <h3>Buttons-->
                <!--                </h3>-->
                <!--            </div>-->
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <code>
<pre>
    <code class="php">
class ControllerName extends UMS_Controller{
    function index(){
        $data['header_title'] = "ชื่อข้อความส่วนหัว";
        $data['header_description'] = "ชื่อข้อความส่วนย่อยของส่วนหัว";

        $data['scripts'] = " code javascript ";
        $data['styles'] = " code styles ";

        $this->output_frontend('view name',$data);
    }
}
        </code>
</pre>
                        </code>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-calendar">
                <h2>การใช้ปฏิทิน</h2>

                <a target="_blank" href="<?php echo site_url('Home/demo_calendar'); ?>"
                   class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search">
                    ดูตัวอย่างหน้า backend
                </a>

            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class='panel-heading'>
                                <h2>ตัวอย่าง ปฏิทินการทำงาน</h2>
                            </div>
                            <div class="cd panel-body calendar-iserl">
                                <div id="menu">
                                <span class="cd dropdown">
                                    <button id="dropdownMenu-calendarType"
                                            class="cd btn btn-default btn-sm dropdown-toggle" type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                        <i id="calendarTypeIcon" class="cd calendar-icon ic_view_month"
                                           style="margin-right: 4px;"></i>
                                        <span id="calendarTypeName">มุมมอง</span>&nbsp;
                                        <i class="cd calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                    </button>
                                    <ul class="cd dropdown-menu" role="menu"
                                        aria-labelledby="dropdownMenu-calendarType">
                                        <li role="presentation">
                                            <a class="cd dropdown-menu-title" role="menuitem"
                                               data-action="toggle-daily">
                                                <i class="cd calendar-icon ic_view_day"></i>รายวัน
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="cd dropdown-menu-title" role="menuitem"
                                               data-action="toggle-weekly">
                                                <i class="cd calendar-icon ic_view_week"></i>รายสัปดาห์
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="cd dropdown-menu-title" role="menuitem"
                                               data-action="toggle-monthly">
                                                <i class="cd calendar-icon ic_view_month"></i>เดือน
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="cd dropdown-menu-title" role="menuitem"
                                               data-action="toggle-weeks2">
                                                <i class="cd calendar-icon ic_view_week"></i>2 สัปดาห์
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="cd dropdown-menu-title" role="menuitem"
                                               data-action="toggle-weeks3">
                                                <i class="cd calendar-icon ic_view_week"></i>3 สัปดาห์
                                            </a>
                                        </li>
                                        <li role="presentation" class="cd dropdown-divider"></li>
                                        <li role="presentation">
                                            <a role="menuitem" data-action="toggle-workweek">
                                                <input type="checkbox" class="cd tui-full-calendar-checkbox-square"
                                                       value="toggle-workweek"
                                                       checked>
                                                <span class="cd checkbox-title"></span>แสดงวันเสาร์ อาทิตย์
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" data-action="toggle-start-day-1">
                                                <input type="checkbox" class="cd tui-full-calendar-checkbox-square"
                                                       value="toggle-start-day-1">
                                                <span class="cd checkbox-title"></span>ให้วันจันทร์เป็นวันแรกของสัปดาห์
                                            </a>
                                        </li>
                                    </ul>
                                    </span>
                                    <span id="menu-navi">
                                        <button type="button" class="cd btn btn-default btn-sm move-today"
                                                data-action="move-today">วันนี้</button>
                                        <button type="button" class="cd btn btn-default btn-sm move-day"
                                                data-action="move-prev">
                                            <i class="cd calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                                        </button>
                                        <button type="button" class="cd btn btn-default btn-sm move-day"
                                                data-action="move-next">
                                            <i class="cd calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                                        </button>
                                    </span>
                                    <span id="renderRange" class="cd render-range"></span>
                                </div>
                                <div id="calendar" style="height: 680px;"></div>
                            </div>
                            <div class="cd panel-footer">
                                <div id="lnb-calendars" class="cd lnb-calendars">
                                    <ul id="calendarList" class="cd lnb-calendars-d1">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">

                        var CalendarList = [];

                        function CalendarInfo() {
                            this.id = null;
                            this.name = null;
                            this.checked = true;
                            this.color = null;
                            this.bgColor = null;
                            this.borderColor = null;
                        }

                        function addCalendar(calendar) {
                            CalendarList.push(calendar);
                        }

                        function findCalendar(id) {
                            var found;

                            CalendarList.forEach(function(calendar) {
                                if (calendar.id === id) {
                                    found = calendar;
                                }
                            });

                            return found || CalendarList[0];
                        }

                        function hexToRGBA(hex) {
                            var radix = 16;
                            var r = parseInt(hex.slice(1, 3), radix),
                                g = parseInt(hex.slice(3, 5), radix),
                                b = parseInt(hex.slice(5, 7), radix),
                                a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
                            var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

                            return rgba;
                        }

                        (function() {
                            var calendar;
                            var id = 0;

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'My Calendar';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#9e5fff';
                            calendar.dragBgColor = '#9e5fff';
                            calendar.borderColor = '#9e5fff';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'Company';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#00a9ff';
                            calendar.dragBgColor = '#00a9ff';
                            calendar.borderColor = '#00a9ff';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'Family';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#ff5583';
                            calendar.dragBgColor = '#ff5583';
                            calendar.borderColor = '#ff5583';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'Friend';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#03bd9e';
                            calendar.dragBgColor = '#03bd9e';
                            calendar.borderColor = '#03bd9e';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'Travel';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#bbdc00';
                            calendar.dragBgColor = '#bbdc00';
                            calendar.borderColor = '#bbdc00';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'etc';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#9d9d9d';
                            calendar.dragBgColor = '#9d9d9d';
                            calendar.borderColor = '#9d9d9d';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'Birthdays';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#ffbb3b';
                            calendar.dragBgColor = '#ffbb3b';
                            calendar.borderColor = '#ffbb3b';
                            addCalendar(calendar);

                            calendar = new CalendarInfo();
                            id += 1;
                            calendar.id = String(id);
                            calendar.name = 'National Holidays';
                            calendar.color = '#ffffff';
                            calendar.bgColor = '#ff4040';
                            calendar.dragBgColor = '#ff4040';
                            calendar.borderColor = '#ff4040';
                            addCalendar(calendar);
                        })();
                        (function (window, Calendar) {
                            var cal, resizeThrottled;
                            var useCreationPopup = true;
                            var useDetailPopup = true;
                            var datePicker, selectedCalendar;

                            cal = new Calendar('#calendar', {
                                defaultView: 'month',
                                useCreationPopup: useCreationPopup,
                                useDetailPopup: useDetailPopup,
                                calendars: CalendarList,
                                isReadOnly: true,
                                month: {
                                    daynames: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.']
                                },
                                week: {
                                    daynames: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.']
                                },
                                template: {
                                    milestone: function (model) {
                                        return '<span class="cd cd-font-icon ic-milestone-b"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
                                    },
                                    allday: function (schedule) {
                                        return getTimeTemplate(schedule, true);
                                    },
                                    time: function (schedule) {
                                        return getTimeTemplate(schedule, false);
                                    }
                                }
                            });

                            // event handlers
                            cal.on({
                                'clickMore': function (e) {
                                    //console.log('clickMore', e);
                                },
                                'clickSchedule': function (e) {
                                    //console.log('clickSchedule', e);
                                    var text_date = $('.tui-full-calendar-popup-detail-date').text()
                                    if (text_date.search(' - ') != '-1') {
                                        var text_split = text_date.split(" - ");

                                        var date_text = moment(text_split[0], "YYYY.MM.DD");
                                        var text_start = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);
                                        date_text = moment(text_split[1], "YYYY.MM.DD");
                                        var text_end = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);

                                        $('.tui-full-calendar-popup-detail-date').text(text_start + ' - ' + text_end);
                                    } else {
                                        var date_text = moment(text_date, "YYYY.MM.DD");
                                        var text_start = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);
                                        $('.tui-full-calendar-popup-detail-date').text(text_start);
                                    }
                                },
                                'clickDayname': function (date) {
                                    //console.log('clickDayname', date);
                                },
                                'beforeCreateSchedule': function (e) {
                                    //console.log('beforeCreateSchedule', e);
                                    saveNewSchedule(e);
                                },
                                'beforeUpdateSchedule': function (e) {
                                    //console.log('beforeUpdateSchedule', e);
                                    e.schedule.start = e.start;
                                    e.schedule.end = e.end;
                                    cal.updateSchedule(e.schedule.id, e.schedule.calendarId, e.schedule);
                                },
                                'beforeDeleteSchedule': function (e) {
                                    //console.log('beforeDeleteSchedule', e);
                                    cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);
                                },
                                'afterRenderSchedule': function (e) {
                                    var schedule = e.schedule;
                                    // var element = cal.getElement(schedule.id, schedule.calendarId);
                                    // console.log('afterRenderSchedule', element);
                                },
                                'clickTimezonesCollapseBtn': function (timezonesCollapsed) {
                                    //console.log('timezonesCollapsed', timezonesCollapsed);

                                    if (timezonesCollapsed) {
                                        cal.setTheme({
                                            'week.daygridLeft.width': '77px',
                                            'week.timegridLeft.width': '77px'
                                        });
                                    } else {
                                        cal.setTheme({
                                            'week.daygridLeft.width': '60px',
                                            'week.timegridLeft.width': '60px'
                                        });
                                    }

                                    return true;
                                }
                            });

                            document.getElementById('calendar').addEventListener('keydown', e => {
                                console.log('keydown', e);
                            });

                            /**
                             * Get time template for time and all-day
                             * @param {Schedule} schedule - schedule
                             * @param {boolean} isAllDay - isAllDay or hasMultiDates
                             * @returns {string}
                             */
                            function getTimeTemplate(schedule, isAllDay) {
                                var html = [];
                                var start = moment(schedule.start.toUTCString());
                                //if (!isAllDay) {
                                //    html.push('<strong>' + start.format('HH:mm') + '</strong> ');
                                //}
                                //html.push('<span class="cd cd-font-icon ic-location-b"></span>');
                                html.push(' ' + schedule.title);
                                /*
                                if (schedule.isPrivate) {
                                    html.push('<span class="cd cd-font-icon ic-lock-b"></span>');
                                    html.push(' Private');
                                } else {
                                    if (schedule.isReadOnly) {
                                        html.push('<span class="cd cd-font-icon ic-readonly-b"></span>');
                                    } else if (schedule.recurrenceRule) {
                                        html.push('<span class="cd cd-font-icon ic-repeat-b"></span>');
                                    } else if (schedule.attendees.length) {
                                        html.push('<span class="cd cd-font-icon ic-user-b"></span>');
                                    } else if (schedule.location) {
                                        html.push('<span class="cd cd-font-icon ic-location-b"></span>');
                                    }
                                    html.push(' ' + schedule.title);
                                }
                                */
                                return html.join('');
                            }

                            /**
                             * A listener for click the menu
                             * @param {Event} e - click event
                             */
                            function onClickMenu(e) {
                                var target = $(e.target).closest('a[role="menuitem"]')[0];
                                var action = getDataAction(target);
                                var options = cal.getOptions();
                                var viewName = '';

                                console.log(target);
                                console.log(action);
                                switch (action) {
                                    case 'toggle-daily':
                                        viewName = 'day';
                                        break;
                                    case 'toggle-weekly':
                                        viewName = 'week';
                                        break;
                                    case 'toggle-monthly':
                                        options.month.visibleWeeksCount = 0;
                                        viewName = 'month';
                                        break;
                                    case 'toggle-weeks2':
                                        options.month.visibleWeeksCount = 2;
                                        viewName = 'month';
                                        break;
                                    case 'toggle-weeks3':
                                        options.month.visibleWeeksCount = 3;
                                        viewName = 'month';
                                        break;
                                    case 'toggle-narrow-weekend':
                                        options.month.narrowWeekend = !options.month.narrowWeekend;
                                        options.week.narrowWeekend = !options.week.narrowWeekend;
                                        viewName = cal.getViewName();

                                        target.querySelector('input').checked = options.month.narrowWeekend;
                                        break;
                                    case 'toggle-start-day-1':
                                        options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
                                        options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
                                        viewName = cal.getViewName();

                                        target.querySelector('input').checked = options.month.startDayOfWeek;
                                        break;
                                    case 'toggle-workweek':
                                        options.month.workweek = !options.month.workweek;
                                        options.week.workweek = !options.week.workweek;
                                        viewName = cal.getViewName();

                                        target.querySelector('input').checked = !options.month.workweek;
                                        break;
                                    default:
                                        break;
                                }

                                cal.setOptions(options, true);
                                cal.changeView(viewName, true);

                                setDropdownCalendarType();
                                setRenderRangeText();
                                //setSchedules();
                            }

                            function onClickNavi(e) {
                                var action = getDataAction(e.target);

                                switch (action) {
                                    case 'move-prev':
                                        cal.prev();
                                        break;
                                    case 'move-next':
                                        cal.next();
                                        break;
                                    case 'move-today':
                                        cal.today();
                                        break;
                                    default:
                                        return;
                                }

                                setRenderRangeText();
                                //setSchedules();
                            }

                            function onChangeCalendars(e) {
                                var calendarId = e.target.value;
                                var checked = e.target.checked;
                                var viewAll = document.querySelector('.lnb-calendars-item input');
                                var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
                                var allCheckedCalendars = true;

                                if (calendarId === 'all') {
                                    allCheckedCalendars = checked;

                                    calendarElements.forEach(function (input) {
                                        var span = input.parentNode;
                                        input.checked = checked;
                                        span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
                                    });

                                    CalendarList.forEach(function (calendar) {
                                        calendar.checked = checked;
                                    });
                                } else {
                                    findCalendar(calendarId).checked = checked;

                                    allCheckedCalendars = calendarElements.every(function (input) {
                                        return input.checked;
                                    });

                                    if (allCheckedCalendars) {
                                        viewAll.checked = true;
                                    } else {
                                        viewAll.checked = false;
                                    }
                                }

                                refreshScheduleVisibility();
                            }

                            function refreshScheduleVisibility() {
                                var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

                                CalendarList.forEach(function (calendar) {
                                    cal.toggleSchedules(calendar.id, !calendar.checked, false);
                                });

                                cal.render(true);

                                calendarElements.forEach(function (input) {
                                    var span = input.nextElementSibling;
                                    span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
                                });
                            }

                            function setDropdownCalendarType() {
                                var calendarTypeName = document.getElementById('calendarTypeName');
                                var calendarTypeIcon = document.getElementById('calendarTypeIcon');
                                var options = cal.getOptions();
                                var type = cal.getViewName();
                                var iconClassName;

                                if (type === 'day') {
                                    type = 'รายวัน';
                                    iconClassName = 'calendar-icon ic_view_day';
                                } else if (type === 'week') {
                                    type = 'รายสัปดาห์';
                                    iconClassName = 'calendar-icon ic_view_week';
                                } else if (options.month.visibleWeeksCount === 2) {
                                    type = '2 สัปดาห์';
                                    iconClassName = 'calendar-icon ic_view_week';
                                } else if (options.month.visibleWeeksCount === 3) {
                                    type = '3 สัปดาห์';
                                    iconClassName = 'calendar-icon ic_view_week';
                                } else {
                                    type = 'เดือน';
                                    iconClassName = 'calendar-icon ic_view_month';
                                }

                                calendarTypeName.innerHTML = type;
                                calendarTypeIcon.className = iconClassName;
                            }

                            function setRenderRangeText() {
                                moment.locale('th');         // th
                                var renderRange = document.getElementById('renderRange');
                                var options = cal.getOptions();
                                var viewName = cal.getViewName();
                                var html = [];
                                if (viewName === 'day') {
                                    html.push(moment(cal.getDate().getTime()).format('DD MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
                                } else if (viewName === 'month' &&
                                    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
                                    html.push(moment(cal.getDate().getTime()).format('MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
                                } else {
                                    html.push(moment(cal.getDate().getTime()).format('DD MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
                                    html.push(' ~ ');
                                    html.push(moment(cal.getDate().getTime()).format('MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
                                }
                                renderRange.innerHTML = html.join('');
                            }

                            function setSchedules() {
                                cal.clear();
                                // var schedules = [];
                                //
                                // $.ajax({
                                //     url: the_path+'/index.php/dashboard/personal_service/Service_calendar/get_data_all',
                                //     type: 'POST',
                                //     dataType: 'json'
                                // })
                                //     .done(function(data) {
                                //         (data.data).forEach(function(input) {
                                //             schedules.push(input);
                                //         });
                                //         cal.createSchedules(schedules);
                                //         refreshScheduleVisibility();
                                //     });
                                generateSchedule(cal.getViewName(), cal.getDateRangeStart(), cal.getDateRangeEnd());
                                cal.createSchedules(ScheduleList);
                                var schedules = [
                                    {
                                        id: 489273,
                                        title: 'Workout for 2018-08-17',
                                        isAllDay: false,
                                        start: '2018-09-06T10:00+09:00',
                                        end: '2018-09-06T14:00:00+09:00',
                                        goingDuration: 30,
                                        comingDuration: 30,
                                        color: '#ffffff',
                                        isVisible: true,
                                        bgColor: '#69BB2D',
                                        dragBgColor: '#69BB2D',
                                        borderColor: '#69BB2D',
                                        calendarId: 'logged-workout',
                                        category: 'time',
                                        dueDateClass: '',
                                        customStyle: 'cursor: default;',
                                        isPending: false,
                                        isFocused: false,
                                        isReadOnly: true,
                                        isPrivate: false,
                                        location: '',
                                        attendees: '',
                                        recurrenceRule: '',
                                        state: ''
                                    },
                                    {
                                        id: 18073,
                                        title: 'completed with blocks',
                                        isAllDay: false,
                                        start: '2018-09-06T09:00:00+09:00',
                                        end: '2018-09-06T10:00:00+09:00',
                                        color: '#ffffff',
                                        isVisible: true,
                                        bgColor: '#54B8CC',
                                        dragBgColor: '#54B8CC',
                                        borderColor: '#54B8CC',
                                        calendarId: 'workout',
                                        category: 'time',
                                        dueDateClass: '',
                                        customStyle: '',
                                        isPending: false,
                                        isFocused: false,
                                        isReadOnly: false,
                                        isPrivate: false,
                                        location: '',
                                        attendees: '',
                                        recurrenceRule: '',
                                        state: ''
                                    }
                                ];
                                cal.createSchedules(schedules);
                                refreshScheduleVisibility();
                            }

                            function setEventListener() {
                                $('#menu-navi').on('click', onClickNavi);
                                $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
                                $('#lnb-calendars').on('change', onChangeCalendars);

                                window.addEventListener('resize', resizeThrottled);
                            }

                            function getDataAction(target) {
                                return target.dataset ? target.dataset.action : target.getAttribute('data-action');
                            }

                            resizeThrottled = tui.util.throttle(function () {
                                cal.render();
                            }, 50);

                            window.cal = cal;

                            setDropdownCalendarType();
                            setRenderRangeText();
                            setSchedules();
                            setEventListener();
                        })(window, tui.Calendar);

                    </script>
                </div>
            </div>

            <div class="cd-section">
                <div class="title">
                    <h3> View </h3>
                </div>
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <code>
<pre>
    <code class="html">
&lt;div class="col-md-12">
        &lt;div class="panel">
            &lt;div class='panel-heading'>
                &lt;h2>ตัวอย่าง ปฏิทินการทำงาน&lt;/h2>
            &lt;/div>
            &lt;div class="cd panel-body calendar-iserl">
                &lt;div id="menu">
                &lt;span class="cd dropdown">
                    &lt;button id="dropdownMenu-calendarType"
                            class="cd btn btn-default btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        &lt;i id="calendarTypeIcon" class="cd calendar-icon ic_view_month"
                           style="margin-right: 4px;">&lt;/i>
                        &lt;span id="calendarTypeName">มุมมอง&lt;/span>&nbsp;
                        &lt;i class="cd calendar-icon tui-full-calendar-dropdown-arrow">&lt;/i>
                    &lt;/button>
                    &lt;ul class="cd dropdown-menu" role="menu"
                        aria-labelledby="dropdownMenu-calendarType">
                        &lt;li role="presentation">
                            &lt;a class="cd dropdown-menu-title" role="menuitem"
                               data-action="toggle-daily">
                                &lt;i class="cd calendar-icon ic_view_day">&lt;/i>รายวัน
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation">
                            &lt;a class="cd dropdown-menu-title" role="menuitem"
                               data-action="toggle-weekly">
                                &lt;i class="cd calendar-icon ic_view_week">&lt;/i>รายสัปดาห์
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation">
                            &lt;a class="cd dropdown-menu-title" role="menuitem"
                               data-action="toggle-monthly">
                                &lt;i class="cd calendar-icon ic_view_month">&lt;/i>เดือน
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation">
                            &lt;a class="cd dropdown-menu-title" role="menuitem"
                               data-action="toggle-weeks2">
                                &lt;i class="cd calendar-icon ic_view_week">&lt;/i>2 สัปดาห์
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation">
                            &lt;a class="cd dropdown-menu-title" role="menuitem"
                               data-action="toggle-weeks3">
                                &lt;i class="cd calendar-icon ic_view_week">&lt;/i>3 สัปดาห์
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation" class="cd dropdown-divider">&lt;/li>
                        &lt;li role="presentation">
                            &lt;a role="menuitem" data-action="toggle-workweek">
                                &lt;input type="checkbox" class="cd tui-full-calendar-checkbox-square"
                                       value="toggle-workweek"
                                       checked>
                                &lt;span class="cd checkbox-title">&lt;/span>แสดงวันเสาร์ อาทิตย์
                            &lt;/a>
                        &lt;/li>
                        &lt;li role="presentation">
                            &lt;a role="menuitem" data-action="toggle-start-day-1">
                                &lt;input type="checkbox" class="cd tui-full-calendar-checkbox-square"
                                       value="toggle-start-day-1">
                                &lt;span class="cd checkbox-title">&lt;/span>ให้วันจันทร์เป็นวันแรกของสัปดาห์
                            &lt;/a>
                        &lt;/li>
                    &lt;/ul>
                    &lt;/span>
                    &lt;span id="menu-navi">
                        &lt;button type="button" class="cd btn btn-default btn-sm move-today"
                                data-action="move-today">วันนี้&lt;/button>
                        &lt;button type="button" class="cd btn btn-default btn-sm move-day"
                                data-action="move-prev">
                            &lt;i class="cd calendar-icon ic-arrow-line-left" data-action="move-prev">&lt;/i>
                        &lt;/button>
                        &lt;button type="button" class="cd btn btn-default btn-sm move-day"
                                data-action="move-next">
                            &lt;i class="cd calendar-icon ic-arrow-line-right" data-action="move-next">&lt;/i>
                        &lt;/button>
                    &lt;/span>
                    &lt;span id="renderRange" class="cd render-range">&lt;/span>
                &lt;/div>
                &lt;div id="calendar" style="height: 680px;">&lt;/div>
            &lt;/div>
            &lt;div class="cd panel-footer">
                &lt;div id="lnb-calendars" class="cd lnb-calendars">
                    &lt;ul id="calendarList" class="cd lnb-calendars-d1">
                    &lt;/ul>
                &lt;/div>
            &lt;/div>
        &lt;/div>
    &lt;/div>
    </code>
</pre>
                        </code>
                    </div>
                </div>
            </div>
            <div class="cd-section">
                <div class="title">
                    <h3> Javascript </h3>
                </div>
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <code>
<pre>
    <code class="javascript">

    var CalendarList = [];

    function CalendarInfo() {
        this.id = null;
        this.name = null;
        this.checked = true;
        this.color = null;
        this.bgColor = null;
        this.borderColor = null;
    }

    function addCalendar(calendar) {
        CalendarList.push(calendar);
    }

    function findCalendar(id) {
        var found;

        CalendarList.forEach(function(calendar) {
            if (calendar.id === id) {
                found = calendar;
            }
        });

        return found || CalendarList[0];
    }

    function hexToRGBA(hex) {
        var radix = 16;
        var r = parseInt(hex.slice(1, 3), radix),
            g = parseInt(hex.slice(3, 5), radix),
            b = parseInt(hex.slice(5, 7), radix),
            a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
        var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

        return rgba;
    }

    (function() {
        var calendar;
        var id = 0;

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'My Calendar';
        calendar.color = '#ffffff';
        calendar.bgColor = '#9e5fff';
        calendar.dragBgColor = '#9e5fff';
        calendar.borderColor = '#9e5fff';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Company';
        calendar.color = '#ffffff';
        calendar.bgColor = '#00a9ff';
        calendar.dragBgColor = '#00a9ff';
        calendar.borderColor = '#00a9ff';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Family';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ff5583';
        calendar.dragBgColor = '#ff5583';
        calendar.borderColor = '#ff5583';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Friend';
        calendar.color = '#ffffff';
        calendar.bgColor = '#03bd9e';
        calendar.dragBgColor = '#03bd9e';
        calendar.borderColor = '#03bd9e';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Travel';
        calendar.color = '#ffffff';
        calendar.bgColor = '#bbdc00';
        calendar.dragBgColor = '#bbdc00';
        calendar.borderColor = '#bbdc00';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'etc';
        calendar.color = '#ffffff';
        calendar.bgColor = '#9d9d9d';
        calendar.dragBgColor = '#9d9d9d';
        calendar.borderColor = '#9d9d9d';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Birthdays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ffbb3b';
        calendar.dragBgColor = '#ffbb3b';
        calendar.borderColor = '#ffbb3b';
        addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'National Holidays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ff4040';
        calendar.dragBgColor = '#ff4040';
        calendar.borderColor = '#ff4040';
        addCalendar(calendar);
    })();
    (function (window, Calendar) {
        var cal, resizeThrottled;
        var useCreationPopup = true;
        var useDetailPopup = true;
        var datePicker, selectedCalendar;

        cal = new Calendar('#calendar', {
            defaultView: 'month',
            useCreationPopup: useCreationPopup,
            useDetailPopup: useDetailPopup,
            calendars: CalendarList,
            isReadOnly: true,
            month: {
                daynames: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.']
            },
            week: {
                daynames: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.']
            },
            template: {
                milestone: function (model) {
                    return '&lt;span class="cd cd-font-icon ic-milestone-b">&lt;/span> &lt;span style="background-color: ' + model.bgColor + '">' + model.title + '&lt;/span>';
                },
                allday: function (schedule) {
                    return getTimeTemplate(schedule, true);
                },
                time: function (schedule) {
                    return getTimeTemplate(schedule, false);
                }
            }
        });

        // event handlers
        cal.on({
            'clickMore': function (e) {
                //console.log('clickMore', e);
            },
            'clickSchedule': function (e) {
                //console.log('clickSchedule', e);
                var text_date = $('.tui-full-calendar-popup-detail-date').text()
                if (text_date.search(' - ') != '-1') {
                    var text_split = text_date.split(" - ");

                    var date_text = moment(text_split[0], "YYYY.MM.DD");
                    var text_start = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);
                    date_text = moment(text_split[1], "YYYY.MM.DD");
                    var text_end = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);

                    $('.tui-full-calendar-popup-detail-date').text(text_start + ' - ' + text_end);
                } else {
                    var date_text = moment(text_date, "YYYY.MM.DD");
                    var text_start = date_text.format('DD MMM ') + (parseInt(date_text.format('YYYY')) + 543);
                    $('.tui-full-calendar-popup-detail-date').text(text_start);
                }
            },
            'clickDayname': function (date) {
                //console.log('clickDayname', date);
            },
            'beforeCreateSchedule': function (e) {
                //console.log('beforeCreateSchedule', e);
                saveNewSchedule(e);
            },
            'beforeUpdateSchedule': function (e) {
                //console.log('beforeUpdateSchedule', e);
                e.schedule.start = e.start;
                e.schedule.end = e.end;
                cal.updateSchedule(e.schedule.id, e.schedule.calendarId, e.schedule);
            },
            'beforeDeleteSchedule': function (e) {
                //console.log('beforeDeleteSchedule', e);
                cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);
            },
            'afterRenderSchedule': function (e) {
                var schedule = e.schedule;
                // var element = cal.getElement(schedule.id, schedule.calendarId);
                // console.log('afterRenderSchedule', element);
            },
            'clickTimezonesCollapseBtn': function (timezonesCollapsed) {
                //console.log('timezonesCollapsed', timezonesCollapsed);

                if (timezonesCollapsed) {
                    cal.setTheme({
                        'week.daygridLeft.width': '77px',
                        'week.timegridLeft.width': '77px'
                    });
                } else {
                    cal.setTheme({
                        'week.daygridLeft.width': '60px',
                        'week.timegridLeft.width': '60px'
                    });
                }

                return true;
            }
        });

        document.getElementById('calendar').addEventListener('keydown', e => {
            console.log('keydown', e);
        });

        /**
         * Get time template for time and all-day
         * @param {Schedule} schedule - schedule
         * @param {boolean} isAllDay - isAllDay or hasMultiDates
         * @returns {string}
         */
        function getTimeTemplate(schedule, isAllDay) {
            var html = [];
            var start = moment(schedule.start.toUTCString());
            //if (!isAllDay) {
            //    html.push('&lt;strong>' + start.format('HH:mm') + '&lt;/strong> ');
            //}
            //html.push('&lt;span class="cd cd-font-icon ic-location-b">&lt;/span>');
            html.push(' ' + schedule.title);
            /*
            if (schedule.isPrivate) {
                html.push('&lt;span class="cd cd-font-icon ic-lock-b">&lt;/span>');
                html.push(' Private');
            } else {
                if (schedule.isReadOnly) {
                    html.push('&lt;span class="cd cd-font-icon ic-readonly-b">&lt;/span>');
                } else if (schedule.recurrenceRule) {
                    html.push('&lt;span class="cd cd-font-icon ic-repeat-b">&lt;/span>');
                } else if (schedule.attendees.length) {
                    html.push('&lt;span class="cd cd-font-icon ic-user-b">&lt;/span>');
                } else if (schedule.location) {
                    html.push('&lt;span class="cd cd-font-icon ic-location-b">&lt;/span>');
                }
                html.push(' ' + schedule.title);
            }
            */
            return html.join('');
        }

        /**
         * A listener for click the menu
         * @param {Event} e - click event
         */
        function onClickMenu(e) {
            var target = $(e.target).closest('a[role="menuitem"]')[0];
            var action = getDataAction(target);
            var options = cal.getOptions();
            var viewName = '';

            console.log(target);
            console.log(action);
            switch (action) {
                case 'toggle-daily':
                    viewName = 'day';
                    break;
                case 'toggle-weekly':
                    viewName = 'week';
                    break;
                case 'toggle-monthly':
                    options.month.visibleWeeksCount = 0;
                    viewName = 'month';
                    break;
                case 'toggle-weeks2':
                    options.month.visibleWeeksCount = 2;
                    viewName = 'month';
                    break;
                case 'toggle-weeks3':
                    options.month.visibleWeeksCount = 3;
                    viewName = 'month';
                    break;
                case 'toggle-narrow-weekend':
                    options.month.narrowWeekend = !options.month.narrowWeekend;
                    options.week.narrowWeekend = !options.week.narrowWeekend;
                    viewName = cal.getViewName();

                    target.querySelector('input').checked = options.month.narrowWeekend;
                    break;
                case 'toggle-start-day-1':
                    options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
                    options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
                    viewName = cal.getViewName();

                    target.querySelector('input').checked = options.month.startDayOfWeek;
                    break;
                case 'toggle-workweek':
                    options.month.workweek = !options.month.workweek;
                    options.week.workweek = !options.week.workweek;
                    viewName = cal.getViewName();

                    target.querySelector('input').checked = !options.month.workweek;
                    break;
                default:
                    break;
            }

            cal.setOptions(options, true);
            cal.changeView(viewName, true);

            setDropdownCalendarType();
            setRenderRangeText();
            //setSchedules();
        }

        function onClickNavi(e) {
            var action = getDataAction(e.target);

            switch (action) {
                case 'move-prev':
                    cal.prev();
                    break;
                case 'move-next':
                    cal.next();
                    break;
                case 'move-today':
                    cal.today();
                    break;
                default:
                    return;
            }

            setRenderRangeText();
            //setSchedules();
        }

        function onChangeCalendars(e) {
            var calendarId = e.target.value;
            var checked = e.target.checked;
            var viewAll = document.querySelector('.lnb-calendars-item input');
            var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
            var allCheckedCalendars = true;

            if (calendarId === 'all') {
                allCheckedCalendars = checked;

                calendarElements.forEach(function (input) {
                    var span = input.parentNode;
                    input.checked = checked;
                    span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
                });

                CalendarList.forEach(function (calendar) {
                    calendar.checked = checked;
                });
            } else {
                findCalendar(calendarId).checked = checked;

                allCheckedCalendars = calendarElements.every(function (input) {
                    return input.checked;
                });

                if (allCheckedCalendars) {
                    viewAll.checked = true;
                } else {
                    viewAll.checked = false;
                }
            }

            refreshScheduleVisibility();
        }

        function refreshScheduleVisibility() {
            var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

            CalendarList.forEach(function (calendar) {
                cal.toggleSchedules(calendar.id, !calendar.checked, false);
            });

            cal.render(true);

            calendarElements.forEach(function (input) {
                var span = input.nextElementSibling;
                span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
            });
        }

        function setDropdownCalendarType() {
            var calendarTypeName = document.getElementById('calendarTypeName');
            var calendarTypeIcon = document.getElementById('calendarTypeIcon');
            var options = cal.getOptions();
            var type = cal.getViewName();
            var iconClassName;

            if (type === 'day') {
                type = 'รายวัน';
                iconClassName = 'calendar-icon ic_view_day';
            } else if (type === 'week') {
                type = 'รายสัปดาห์';
                iconClassName = 'calendar-icon ic_view_week';
            } else if (options.month.visibleWeeksCount === 2) {
                type = '2 สัปดาห์';
                iconClassName = 'calendar-icon ic_view_week';
            } else if (options.month.visibleWeeksCount === 3) {
                type = '3 สัปดาห์';
                iconClassName = 'calendar-icon ic_view_week';
            } else {
                type = 'เดือน';
                iconClassName = 'calendar-icon ic_view_month';
            }

            calendarTypeName.innerHTML = type;
            calendarTypeIcon.className = iconClassName;
        }

        function setRenderRangeText() {
            moment.locale('th');         // th
            var renderRange = document.getElementById('renderRange');
            var options = cal.getOptions();
            var viewName = cal.getViewName();
            var html = [];
            if (viewName === 'day') {
                html.push(moment(cal.getDate().getTime()).format('DD MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
            } else if (viewName === 'month' &&
                (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
                html.push(moment(cal.getDate().getTime()).format('MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
            } else {
                html.push(moment(cal.getDate().getTime()).format('DD MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
                html.push(' ~ ');
                html.push(moment(cal.getDate().getTime()).format('MMMM') + ' ' + (parseInt(moment(cal.getDate().getTime()).format('YYYY')) + 543));
            }
            renderRange.innerHTML = html.join('');
        }

        function setSchedules() {
            cal.clear();
            // var schedules = [];
            //
            // $.ajax({
            //     url: the_path+'/index.php/dashboard/personal_service/Service_calendar/get_data_all',
            //     type: 'POST',
            //     dataType: 'json'
            // })
            //     .done(function(data) {
            //         (data.data).forEach(function(input) {
            //             schedules.push(input);
            //         });
            //         cal.createSchedules(schedules);
            //         refreshScheduleVisibility();
            //     });
            generateSchedule(cal.getViewName(), cal.getDateRangeStart(), cal.getDateRangeEnd());
            cal.createSchedules(ScheduleList);
            var schedules = [
                {
                    id: 489273,
                    title: 'Workout for 2018-08-17',
                    isAllDay: false,
                    start: '2018-09-06T10:00+09:00',
                    end: '2018-09-06T14:00:00+09:00',
                    goingDuration: 30,
                    comingDuration: 30,
                    color: '#ffffff',
                    isVisible: true,
                    bgColor: '#69BB2D',
                    dragBgColor: '#69BB2D',
                    borderColor: '#69BB2D',
                    calendarId: 'logged-workout',
                    category: 'time',
                    dueDateClass: '',
                    customStyle: 'cursor: default;',
                    isPending: false,
                    isFocused: false,
                    isReadOnly: true,
                    isPrivate: false,
                    location: '',
                    attendees: '',
                    recurrenceRule: '',
                    state: ''
                },
                {
                    id: 18073,
                    title: 'completed with blocks',
                    isAllDay: false,
                    start: '2018-09-06T09:00:00+09:00',
                    end: '2018-09-06T10:00:00+09:00',
                    color: '#ffffff',
                    isVisible: true,
                    bgColor: '#54B8CC',
                    dragBgColor: '#54B8CC',
                    borderColor: '#54B8CC',
                    calendarId: 'workout',
                    category: 'time',
                    dueDateClass: '',
                    customStyle: '',
                    isPending: false,
                    isFocused: false,
                    isReadOnly: false,
                    isPrivate: false,
                    location: '',
                    attendees: '',
                    recurrenceRule: '',
                    state: ''
                }
            ];
            cal.createSchedules(schedules);
            refreshScheduleVisibility();
        }

        function setEventListener() {
            $('#menu-navi').on('click', onClickNavi);
            $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
            $('#lnb-calendars').on('change', onChangeCalendars);

            window.addEventListener('resize', resizeThrottled);
        }

        function getDataAction(target) {
            return target.dataset ? target.dataset.action : target.getAttribute('data-action');
        }

        resizeThrottled = tui.util.throttle(function () {
            cal.render();
        }, 50);

        window.cal = cal;

        setDropdownCalendarType();
        setRenderRangeText();
        setSchedules();
        setEventListener();
    })(window, tui.Calendar);

    </code>
</pre>
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-excel">
                <h2>การใช้ phpspreadsheet ในการ export to excel file</h2>
            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <code>
                            <a href="<?php echo site_url('Home/Export_excel'); ?>"
                               class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="">ตัวอย่าง
                                Export Excel</a>
                            <pre>
<code class="php">
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ControllerName extends UMS_Controller{
	function Export_excel(){
		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
		
		$sheet = $spreadsheet->getActiveSheet();
		
		// manually set table data value
		$sheet->setCellValue('A1', 'Gipsy Danger'); 
		$sheet->setCellValue('A2', 'Gipsy Avenger');
		$sheet->setCellValue('A3', 'Striker Eureka');
    
		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
		
		$filename = 'list-of-jaegers'; // set filename for excel file to be exported
		
		
		header('Content-Type: application/vnd.ms-excel'); // generate excel file
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		ob_end_clean();
		
		$writer->save('php://output');	// download file 
	}
}
</code>
						</pre>

                        </code>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-upload">
                <h2>การ uploads file </h2>
            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <div class="row">
                            <div class="col-lg-8 col-sm-4">
                                <form class="form-horizontal row-border" id="validate-form1" data-parsley-validate
                                      method="post" enctype="multipart/form-data"
                                      action="<?php echo site_url() ?>/Home/import_file">

                                    <div class="form-group form-file-upload form-file-multiple">
                                        <input type="file" name="DataExcel[]" multiple="" class="inputFileHidden">
                                        <div class="input-group">
                                            <input type="text" class="form-control inputFileVisible"
                                                   placeholder="Multiple Files" multiple>
                                            <span class="input-group-btn">
								<button type="button" class="btn btn-link btn-fab btn-info">
								<i class="material-icons">layers</i>
								</button>
							</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="Submit">Uploads</button>
                                </form>
                            </div>
                        </div>
                        <code>
				
						<pre>
<code class="php">
function import_file(){
		// input post type files;
		$files = $_FILES['DataExcel'];  	
		// Path file uploads 
		$uploads_dir  = $this->config->item('uploads_dir')."umsExcel";
		// loop check file error 
		foreach($files['error'] as $key=>$value){
			$error =  $value;
			if ($error == UPLOAD_ERR_OK) {
				// value temp name
				$tmp_name = $files['tmp_name'][$key];
				// value file name
				$name =  $files['name'][$key];
				// uploads file to server
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}else{
				echo "Can't Upload";
			}
		}
		// redir or $this->output()
		redirect('Home/demo_code', 'refresh');
	}
</code>
						</pre>

                        </code>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-wizard">
                <h2>การ form wizard</h2>
            </div>
            <div class="cd-section">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card card-wizard" data-color="primary" id="wizardProfile">
                        <form action="" method="">
                            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                            <div class="text-center">
                                <h3 class="card-title">
                                    Build Your Profile
                                </h3>
                                <h5 class="card-description">This information will let us know more about you.</h5>
                            </div>
                            <div class="wizard-navigation">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                                            1. About
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                                            2. Account
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#address" data-toggle="tab" role="tab">
                                            3. Address
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="about">
                                        <h5 class="info-text"> Let's start with the basic information (with
                                            validation)</h5>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-4">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="<?php echo base_url(); ?>frontend/assets/img/default-avatar.png"
                                                             class="picture-src" id="wizardPicturePreview" title=""/>
                                                        <input type="file" id="wizard-picture">
                                                    </div>
                                                    <h6 class="description">Choose Picture</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group form-control-lg">
                                                    <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="material-icons">face</i>
                </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInput1" class="bmd-label-floating">First Name
                                                            (required)</label>
                                                        <input type="text" class="form-control" id="exampleInput1"
                                                               name="firstname" required>
                                                    </div>
                                                </div>
                                                <div class="input-group form-control-lg">
                                                    <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="material-icons">record_voice_over</i>
                </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInput11" class="bmd-label-floating">Second
                                                            Name</label>
                                                        <input type="text" class="form-control" id="exampleInput11"
                                                               name="lastname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 mt-3">
                                                <div class="input-group form-control-lg">
                                                    <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="material-icons">email</i>
                </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInput1" class="bmd-label-floating">Email
                                                            (required)</label>
                                                        <input type="email" class="form-control" id="exampleemalil"
                                                               name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="account">
                                        <h5 class="info-text"> What are you doing? (checkboxes) </h5>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="choice" data-toggle="wizard-checkbox">
                                                            <input type="checkbox" name="jobb" value="Design">
                                                            <div class="icon">
                                                                <i class="fa fa-pencil"></i>
                                                            </div>
                                                            <h6>Design</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="choice" data-toggle="wizard-checkbox">
                                                            <input type="checkbox" name="jobb" value="Code">
                                                            <div class="icon">
                                                                <i class="fa fa-terminal"></i>
                                                            </div>
                                                            <h6>Code</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="choice" data-toggle="wizard-checkbox">
                                                            <input type="checkbox" name="jobb" value="Develop">
                                                            <div class="icon">
                                                                <i class="fa fa-laptop"></i>
                                                            </div>
                                                            <h6>Develop</h6>
                                                        </div>
                                                        <select class="selectpicker"
                                                                data-style="btn btn-primary btn-round"
                                                                title="Single Select" data-size="7">
                                                            <option disabled selected>Choose city</option>
                                                            <option value="2">Foobar</option>
                                                            <option value="3">Is great</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="address">
                                        <div class="row justify-content-center">
                                            <div class="col-sm-12">
                                                <h5 class="info-text"> Are you living in a nice area? </h5>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <label>Street Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Street No.</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group select-wizard">
                                                    <label>Country</label>
                                                    <select class="selectpicker" data-size="7"
                                                            data-style="select-with-transition" title="Single Select">
                                                        <option value="Afghanistan"> Afghanistan</option>
                                                        <option value="Albania"> Albania</option>
                                                        <option value="Algeria"> Algeria</option>
                                                        <option value="American Samoa"> American Samoa</option>
                                                        <option value="Andorra"> Andorra</option>
                                                        <option value="Angola"> Angola</option>
                                                        <option value="Anguilla"> Anguilla</option>
                                                        <option value="Antarctica"> Antarctica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="mr-auto">
                                    <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                                           name="previous" value="Previous">
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next"
                                           value="Next">
                                    <input type="button" class="btn btn-finish btn-fill btn-success btn-wd"
                                           name="finish" value="Finish" style="display: none;">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- wizard container -->
            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="row">
                        </div>
                        <pre>
<code class="html">
<!--      Wizard container        -->
    &lt;div class="wizard-container"&gt;
        &lt;div class="card card-wizard" data-color="primary" id="wizardProfile"&gt;
            &lt;form action="" method=""&gt;
                &lt;!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       --&gt;
                &lt;div class="text-center"&gt;
                    &lt;h3 class="card-title"&gt;
                        Build Your Profile
                    &lt;/h3&gt;
                    &lt;h5 class="card-description"&gt;This information will let us know more about you.&lt;/h5&gt;
                &lt;/div&gt;
                &lt;div class="wizard-navigation"&gt;
                    &lt;ul class="nav nav-pills"&gt;
                        &lt;li class="nav-item"&gt;
                            &lt;a class="nav-link active" href="#about" data-toggle="tab" role="tab"&gt;
                                1. About
                            &lt;/a&gt;
                        &lt;/li&gt;
                        &lt;li class="nav-item"&gt;
                            &lt;a class="nav-link" href="#account" data-toggle="tab" role="tab"&gt;
                                2. Account
                            &lt;/a&gt;
                        &lt;/li&gt;
                        &lt;li class="nav-item"&gt;
                            &lt;a class="nav-link" href="#address" data-toggle="tab" role="tab"&gt;
                                3. Address
                            &lt;/a&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/div&gt;
                &lt;div class="card-body"&gt;
                    &lt;div class="tab-content"&gt;
                        &lt;div class="tab-pane active" id="about"&gt;
                            &lt;h5 class="info-text"&gt; Let's start with the basic information (with validation)&lt;/h5&gt;
                            &lt;div class="row justify-content-center"&gt;
                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="picture-container"&gt;
                                        &lt;div class="picture"&gt;
                                            &lt;img src="&lt;?php echo base_url();?&gt;frontend/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title="" /&gt;
                                            &lt;input type="file" id="wizard-picture"&gt;
                                        &lt;/div&gt;
                                        &lt;h6 class="description"&gt;Choose Picture&lt;/h6&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-sm-6"&gt;
                                    &lt;div class="input-group form-control-lg"&gt;
                                        &lt;div class="input-group-prepend"&gt;
                            &lt;span class="input-group-text"&gt;
                              &lt;i class="material-icons"&gt;face&lt;/i&gt;
                            &lt;/span&gt;
                                        &lt;/div&gt;
                                        &lt;div class="form-group"&gt;
                                            &lt;label for="exampleInput1" class="bmd-label-floating"&gt;First Name (required)&lt;/label&gt;
                                            &lt;input type="text" class="form-control" id="exampleInput1" name="firstname" required&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                    &lt;div class="input-group form-control-lg"&gt;
                                        &lt;div class="input-group-prepend"&gt;
                            &lt;span class="input-group-text"&gt;
                              &lt;i class="material-icons"&gt;record_voice_over&lt;/i&gt;
                            &lt;/span&gt;
                                        &lt;/div&gt;
                                        &lt;div class="form-group"&gt;
                                            &lt;label for="exampleInput11" class="bmd-label-floating"&gt;Second Name&lt;/label&gt;
                                            &lt;input type="text" class="form-control" id="exampleInput11" name="lastname" required&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-lg-10 mt-3"&gt;
                                    &lt;div class="input-group form-control-lg"&gt;
                                        &lt;div class="input-group-prepend"&gt;
                            &lt;span class="input-group-text"&gt;
                              &lt;i class="material-icons"&gt;email&lt;/i&gt;
                            &lt;/span&gt;
                                        &lt;/div&gt;
                                        &lt;div class="form-group"&gt;
                                            &lt;label for="exampleInput1" class="bmd-label-floating"&gt;Email (required)&lt;/label&gt;
                                            &lt;input type="email" class="form-control" id="exampleemalil" name="email" required&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class="tab-pane" id="account"&gt;
                            &lt;h5 class="info-text"&gt; What are you doing? (checkboxes) &lt;/h5&gt;
                            &lt;div class="row justify-content-center"&gt;
                                &lt;div class="col-lg-10"&gt;
                                    &lt;div class="row"&gt;
                                        &lt;div class="col-sm-4"&gt;
                                            &lt;div class="choice" data-toggle="wizard-checkbox"&gt;
                                                &lt;input type="checkbox" name="jobb" value="Design"&gt;
                                                &lt;div class="icon"&gt;
                                                    &lt;i class="fa fa-pencil"&gt;&lt;/i&gt;
                                                &lt;/div&gt;
                                                &lt;h6&gt;Design&lt;/h6&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                        &lt;div class="col-sm-4"&gt;
                                            &lt;div class="choice" data-toggle="wizard-checkbox"&gt;
                                                &lt;input type="checkbox" name="jobb" value="Code"&gt;
                                                &lt;div class="icon"&gt;
                                                    &lt;i class="fa fa-terminal"&gt;&lt;/i&gt;
                                                &lt;/div&gt;
                                                &lt;h6&gt;Code&lt;/h6&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                        &lt;div class="col-sm-4"&gt;
                                            &lt;div class="choice" data-toggle="wizard-checkbox"&gt;
                                                &lt;input type="checkbox" name="jobb" value="Develop"&gt;
                                                &lt;div class="icon"&gt;
                                                    &lt;i class="fa fa-laptop"&gt;&lt;/i&gt;
                                                &lt;/div&gt;
                                                &lt;h6&gt;Develop&lt;/h6&gt;
                                            &lt;/div&gt;
                                            &lt;select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7"&gt;
                                                &lt;option disabled selected&gt;Choose city&lt;/option&gt;
                                                &lt;option value="2"&gt;Foobar&lt;/option&gt;
                                                &lt;option value="3"&gt;Is great&lt;/option&gt;
                                            &lt;/select&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class="tab-pane" id="address"&gt;
                            &lt;div class="row justify-content-center"&gt;
                                &lt;div class="col-sm-12"&gt;
                                    &lt;h5 class="info-text"&gt; Are you living in a nice area? &lt;/h5&gt;
                                &lt;/div&gt;
                                &lt;div class="col-sm-7"&gt;
                                    &lt;div class="form-group"&gt;
                                        &lt;label&gt;Street Name&lt;/label&gt;
                                        &lt;input type="text" class="form-control"&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-sm-3"&gt;
                                    &lt;div class="form-group"&gt;
                                        &lt;label&gt;Street No.&lt;/label&gt;
                                        &lt;input type="text" class="form-control"&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-sm-5"&gt;
                                    &lt;div class="form-group"&gt;
                                        &lt;label&gt;City&lt;/label&gt;
                                        &lt;input type="text" class="form-control"&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-sm-5"&gt;
                                    &lt;div class="form-group select-wizard"&gt;
                                        &lt;label&gt;Country&lt;/label&gt;
                                        &lt;select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select"&gt;
                                            &lt;option value="Afghanistan"&gt; Afghanistan &lt;/option&gt;
                                            &lt;option value="Albania"&gt; Albania &lt;/option&gt;
                                            &lt;option value="Algeria"&gt; Algeria &lt;/option&gt;
                                            &lt;option value="American Samoa"&gt; American Samoa &lt;/option&gt;
                                            &lt;option value="Andorra"&gt; Andorra &lt;/option&gt;
                                            &lt;option value="Angola"&gt; Angola &lt;/option&gt;
                                            &lt;option value="Anguilla"&gt; Anguilla &lt;/option&gt;
                                            &lt;option value="Antarctica"&gt; Antarctica &lt;/option&gt;
                                        &lt;/select&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
                &lt;div class="card-footer"&gt;
                    &lt;div class="mr-auto"&gt;
                        &lt;input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous"&gt;
                    &lt;/div&gt;
                    &lt;div class="ml-auto"&gt;
                        &lt;input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" value="Next"&gt;
                        &lt;input type="button" class="btn btn-finish btn-fill btn-success btn-wd" name="finish" value="Finish" style="display: none;"&gt;
                    &lt;/div&gt;
                    &lt;div class="clearfix"&gt;&lt;/div&gt;
                &lt;/div&gt;
            &lt;/form&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    <!-- wizard container -->
</code>
</pre>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-autocom">
                <h2>การดึงข้อมูล ตำบล อำเภอ จังหวัด</h2>
            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-4">
                                <div class="form-group has-default">
                                    <input type="text" class="autocomplete-district form-control" placeholder="ตำบล"
                                           get="get_address" id="psd_dist_id" value="">
                                    <input type="hidden" id="psd_addhome_dist_id" name="psd_addhome_dist_id" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <div class="form-group has-default">
                                    <input type="text" value="" id="psd_amph_id" class="form-control"
                                           placeholder="อำเภอ"
                                           disabled>
                                    <input type="hidden" name="psd_addhome_amph_id" id="psd_addhome_amph_id" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <div class="form-group has-default">
                                    <input type="text" value="" id="psd_pv_id" class="form-control"
                                           placeholder="จังหวัด"
                                           disabled>
                                    <input type="hidden" name="psd_addhome_pv_id" id="psd_addhome_pv_id" value="">
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var globaldata = "";
                            var numrow;
                            var sub_contract = "";
                            var currentStep = 0;
                            $(document).ready(function () {
                                $(".autocomplete-district").on("keydown", function (event) { //onkeydown
                                    switch (event.keyCode) {
                                        case 38: 			// up
                                            moveactive1(-1);
                                            break;
                                        case 40: 			// down
                                            moveactive1(1);
                                            break;
                                        case 9:  			// tab
                                            $(document).find(".autocomplete-block").each(function (index) {
                                                acLink1(currentStep);				//go to function acLink
                                            });
                                            break;
                                        case 13:			// return
                                            event.cancelBubble = false;		//stop event
                                            event.returnValue = false;		//
                                            $(document).find(".autocomplete-block").each(function (index) {
                                                acLink1(currentStep);				//go to function acLink
                                            });
                                            return false;
                                            break;
                                    }
                                    $(this).attr("autocomplete", "off");	//set attribute autocomplete=off
                                }).on("keyup", function (event) { //onkeyup
                                    switch (event.keyCode) {
                                        case 38: 			// up
                                        case 40: 			// down
                                        case 9:  			// tab
                                        case 13:			// return
                                            return;
                                    }
                                    obj = $(this);
                                    get = obj.attr("get"); 	//set get ,for append url
                                    key = obj.val();		//set key ,for search

                                    url = "<?php echo site_url("/hr/HR_Controller/get_address");?>";	// get append url

                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {q: key},
                                        dataType: "json",
                                        success: function (data, textStatus, jqXHR) {
                                            if (data != null && data != '') {
                                                globaldata = data;
                                                li = "";
                                                $.each(data, function (i, item) {
                                                    li += "<li class=\"dropdown-item\" onclick=\"acLink1(" + i
                                                        + ")\"><a href=\"javascript:void(0);\">" + item.dist_name + "<br>" + item.name + "</a></li>";		// add to list autocomplete
                                                });
                                                $(".autocomplete-block").remove();	//delete block list autocomplete
                                                if (li == "") {		//if li not value -> stop
                                                    return;
                                                }
                                                obj.before("<div class=\"autocomplete-block dropdown\"><ul class=\"dropdown-menu show\">"
                                                    + li + "</ul></div>"); 	//add list autocomplete to block
                                                $("li.dropdown-item").first().addClass("active");	//li active at first row
                                                currentStep = 0;		//first row -> currentStep = 0
                                                // $('.autocomplete-block').css('position', 'absolute');
                                                // $('.autocomplete-block').css('z-index', 99999999);
                                            } else {
                                                $(".autocomplete-block").remove();	//delete block list autocomplete
                                            }

                                        },
                                        error: function (xhr, status, error) {
                                            //alert ("Error: " + error);
                                            $(".autocomplete-block").remove();	//delete block list autocomplete
                                        }
                                    });

                                });

                            });

                            function acLink1(id) {
                                var data = globaldata[id];
                                if (get == "get_address") {	//-- กำหนด
                                    //set value in Author
                                    $("#psd_addhome_dist_id").val(data.dist_id);
                                    $("#psd_dist_id").val(data.dist_name);
                                    $("#psd_addhome_pv_id").val(data.pv_id);
                                    $("#psd_pv_id").val(data.pv_name);
                                    $("#psd_addhome_amph_id").val(data.amph_id);
                                    $("#psd_amph_id").val(data.amph_name);
                                }
                                $(".autocomplete-block").remove();
                            }

                            function moveactive1(step) {
                                if (step == -1 && currentStep == 0) {
                                    return false;
                                }
                                if (step == 1 && currentStep == numrow - 2) {
                                    return false;
                                }
                                currentStep = currentStep + step;
                                $("li.dropdown-item").removeClass("active");
                                $("li.dropdown-item:eq(" + currentStep + ")").addClass("active");
                            }
                        </script>
                    </div>
                    <div class="col-md-12">
                        <div class="cd-section">
                            <div class="title">
                                <h3> View </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <code>
<pre>
    <code class="html">
&lt;div class="row">
    &lt;div class="col-lg-3 col-sm-4">
        &lt;div class="form-group has-default">
            &lt;input type = "text" class="autocomplete-district form-control" placeholder="ตำบล" get="get_address" id="psd_dist_id" value = "">
            &lt;input type = "hidden" id="psd_addhome_dist_id" name = "psd_addhome_dist_id" value = "">
        &lt;/div>
    &lt;/div>
    &lt;div class="col-lg-3 col-sm-4">
        &lt;div class="form-group has-default">
            &lt;input type = "text" value="" id="psd_amph_id" class="form-control" placeholder="อำเภอ" disabled >
            &lt;input type = "hidden"  name="psd_addhome_amph_id" id="psd_addhome_amph_id" value="">
        &lt;/div>
    &lt;/div>
    &lt;div class="col-lg-3 col-sm-4">
        &lt;div class="form-group has-default">
            &lt;input type = "text" value=""  id="psd_pv_id" class="form-control" placeholder="จังหวัด" disabled>
            &lt;input type = "hidden" name="psd_addhome_pv_id" id="psd_addhome_pv_id" value="">
        &lt;/div>
    &lt;/div>
&lt;/div>
    </code>
</pre>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="cd-section">
                            <div class="title">
                                <h3> Javascript </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <code>
<pre>
    <code class="javascript">
var globaldata = "";
var numrow;
var sub_contract = "";
var currentStep = 0;
$(document).ready(function(){
    $(".autocomplete-district").on("keydown",function(event) { //onkeydown
        switch(event.keyCode) {
            case 38: 			// up
                moveactive1(-1);
                break;
            case 40: 			// down
                moveactive1(1);
                break;
            case 9:  			// tab
                $(document).find(".autocomplete-block").each(function(index) {
                    acLink1(currentStep);				//go to function acLink
                });
                break;
            case 13:			// return
                event.cancelBubble = false;		//stop event
                event.returnValue = false;		//
                $(document).find(".autocomplete-block").each(function(index) {
                    acLink1(currentStep);				//go to function acLink
                });
                return false;
                break;
        }
        $(this).attr("autocomplete","off");	//set attribute autocomplete=off
    }).on("keyup",function(event) { //onkeyup
        switch(event.keyCode) {
            case 38: 			// up
            case 40: 			// down
            case 9:  			// tab
            case 13:			// return
                return;
        }
        obj = $(this);
        get = obj.attr("get"); 	//set get ,for append url
        key = obj.val();		//set key ,for search

        url = "&lt;?php echo site_url("/hr/HR_Controller/get_address");?>";	// get append url

        $.ajax({
            type: "POST",
            url: url,
            data:  { q: key},
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
                if(data != null && data!=''){
                    globaldata = data;
                    li = "";
                    $.each(data, function(i,item){
                        li += "&lt;li class=\"dropdown-item\" onclick=\"acLink1("+i
                                   +")\">&lt;a href=\"javascript:void(0);\">"+item.dist_name+"&lt;br>"+item.name+"&lt;/a>&lt;/li>";		// add to list autocomplete
                    });
                    $(".autocomplete-block").remove();	//delete block list autocomplete
                    if(li == ""){		//if li not value -> stop
                        return;
                    }
                    obj.before("&lt;div class=\"autocomplete-block dropdown\">&lt;ul class=\"dropdown-menu show\">"
                        +li+"&lt;/ul>&lt;/div>"); 	//add list autocomplete to block
    $("li.dropdown-item").first().addClass("active");	//li active at first row
    currentStep = 0;		//first row -> currentStep = 0
    // $('.autocomplete-block').css('position', 'absolute');
    // $('.autocomplete-block').css('z-index', 99999999);
    }else {
        $(".autocomplete-block").remove();	//delete block list autocomplete
    }

    },
    error: function(xhr, status, error) {
        //alert ("Error: " + error);
        $(".autocomplete-block").remove();	//delete block list autocomplete
    }
    });

    });

});

function acLink1(id){
    var data = globaldata[id];
    if(get == "get_address"){	//-- กำหนด
        //set value in Author
        $("#psd_addhome_dist_id").val(data.dist_id);
        $("#psd_dist_id").val(data.dist_name);
        $("#psd_addhome_pv_id").val(data.pv_id);
        $("#psd_pv_id").val(data.pv_name);
        $("#psd_addhome_amph_id").val(data.amph_id);
        $("#psd_amph_id").val(data.amph_name);
    }
    $(".autocomplete-block").remove();
}

function moveactive1(step){
    if(step == -1 && currentStep == 0){
        return false;
    }
    if(step == 1 && currentStep == numrow-2){
        return false;
    }
    currentStep = currentStep + step;
    $("li.dropdown-item").removeClass("active");
    $("li.dropdown-item:eq("+currentStep+")").addClass("active");
}
    </code>
</pre>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="title" id="use-datepicker">
                <h2>การ Datepicker</h2>
            </div>
            <div id="" class="cd-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-4">
                                <div class="form-group has-default">
                                    <input type="text" class="datepicker-thai form-control" placeholder="วันที่/เดือน/ปี"
                                           id="" value="">
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">

                        </script>
                    </div>
                    <div class="col-md-12">
                        <div class="cd-section">
                            <div class="title">
                                <h3> View </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <code>
<pre>
    <code class="html">
        &lt;input type="text" class="datepicker-thai form-control" placeholder="วันที่/เดือน/ปี"
               id="" value="">
    </code>
</pre>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<nav id="cd-vertical-nav" style="" class="">
    <ul>
        <li>
            <a href="#use-controller" data-number="1">
                <span class="cd-dot"></span>
                <span class="cd-label">การใช้ Controllers</span>
            </a>
        </li>
        <li>
            <a href="#use-calendar" data-number="2">
                <span class="cd-dot"></span>
                <span class="cd-label">การใช้ปฏิทิน</span>
            </a>
        </li>
        <li>
            <a href="#use-excel" data-number="3">
                <span class="cd-dot"></span>
                <span class="cd-label">การใช้ phpspreadsheet ในการ export to excel file</span>
            </a>
        </li>
        <li>
            <a href="#use-upload" data-number="4">
                <span class="cd-dot"></span>
                <span class="cd-label">การ uploads file</span>
            </a>
        </li>
        <li>
            <a href="#use-wizard" data-number="5">
                <span class="cd-dot"></span>
                <span class="cd-label">การ form wizard</span>
            </a>
        </li>
        <li>
            <a href="#use-autocom" data-number="6">
                <span class="cd-dot"></span>
                <span class="cd-label">การดึงข้อมูล ตำบล อำเภอ จังหวัด</span>
            </a>
        </li>
        <li>
            <a href="#use-datepicker" data-number="6">
                <span class="cd-dot"></span>
                <span class="cd-label">การใช้ Datepicker ไทย</span>
            </a>
        </li>
    </ul>
</nav>
