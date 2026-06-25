export function useAdviserMockData() {
  const assignedClasses = [
    { id: 1, course: 'CS 201', section: 'A', students: 32, schedule: 'MWF 7:30–8:30 • SC 201' },
    { id: 2, course: 'CS 101', section: 'B', students: 28, schedule: 'MWF 9:00–10:30 • SC 101' },
    { id: 3, course: 'CS 202', section: 'B', students: 35, schedule: 'MWF 7:30–8:30 • SC 201' },
    { id: 4, course: 'CS 102', section: 'C', students: 27, schedule: 'MWF 9:00–10:30 • SC 101' },
    { id: 5, course: 'CS 203', section: 'C', students: 35, schedule: 'MWF 7:30–8:30 • SC 201' },
    { id: 6, course: 'CS 103', section: 'D', students: 25, schedule: 'MWF 9:00–10:30 • SC 101' },
    { id: 7, course: 'CS 204', section: 'D', students: 35, schedule: 'MWF 7:30–8:30 • SC 201' },
    { id: 8, course: 'CS 104', section: 'E', students: 27, schedule: 'MWF 9:00–10:30 • SC 101' },
  ]

  const studentsList = [
    { no: 1, initials: 'GC', name: 'Grachelle Mae A. Carmelotes', id: '202604720', year: '3rd Year', program: 'BS CS', gwa: '1.75', units: '51/107', status: 'Good Standing', flags: [] },
    { no: 2, initials: 'JD', name: 'Juan Dela Cruz', id: '202605130', year: '3rd Year', program: 'BS CS', gwa: '2.25', units: '48/107', status: 'Needs Attention', flags: ['Low GWA'] },
    { no: 3, initials: 'CR', name: 'Carlo Reyes', id: '202606444', year: '3rd Year', program: 'BS CS', gwa: '1.50', units: '54/107', status: 'Good Standing', flags: [] },
    { no: 4, initials: 'BL', name: 'Bong Lim', id: '202606791', year: '3rd Year', program: 'BS CS', gwa: '2.75', units: '45/107', status: 'Needs Attention', flags: ['Low GWA'] },
    { no: 5, initials: 'RT', name: 'Rosa Torres', id: '202605812', year: '3rd Year', program: 'BS CS', gwa: '1.25', units: '42/107', status: 'Good Standing', flags: [] },
    { no: 6, initials: 'MF', name: 'Mike Flores', id: '202605982', year: '3rd Year', program: 'BS CS', gwa: '1.75', units: '57/107', status: 'Good Standing', flags: [] },
  ]

  return {
    assignedClasses,
    studentsList,
  }
}
