import { defineStore } from 'pinia'
import { CurriculumService, type CurriculumYear, type College, type Program } from '~/services/curriculum.service'

export const useCurriculumStore = defineStore('curriculum', {
  state: () => ({
    curriculumYears: [] as CurriculumYear[],
    colleges: [] as College[],
    programs: [] as Program[],
    loading: false,
    error: null as string | null,
    initialized: false
  }),

  actions: {
    async fetchInitialData() {
      if (this.initialized) return

      this.loading = true
      this.error = null

      try {
        const [years, colleges, programs] = await Promise.all([
          CurriculumService.getCurriculumYears(),
          CurriculumService.getColleges(),
          CurriculumService.getPrograms()
        ])

        this.curriculumYears = years
        this.colleges = colleges
        this.programs = programs
        this.initialized = true
      } catch (err: any) {
        this.error = err?.response?.data?.message || err.message || 'Failed to fetch curriculum data'
        console.error('Error fetching curriculum data:', err)
      } finally {
        this.loading = false
      }
    }
  }
})
