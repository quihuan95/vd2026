export function createProgramFilter(rows) {
    const rooms = [];
    const sections = [];
    let room;
    let section;

    rows.forEach((row, index) => {
        const text = row.cells.flat().join(' ');

        if (row.kind === 'hall') {
            room = { id: String(index), index, label: row.cells[0].join(' / ') };
            rooms.push(room);
            section = null;
        } else if (row.kind === 'session') {
            section = {
                index,
                room,
                number: text.match(/Phiên\s+(\d+)/u)?.[1] || '',
                text: text.toLocaleLowerCase('vi'),
                entries: [],
            };
            sections.push(section);
        } else if (section) {
            section.entries.push({ index, text: text.toLocaleLowerCase('vi') });
        }
    });

    return {
        searchQuery: '',
        selectedRoom: '',
        selectedSession: '',
        rooms,
        visibleRowIndices: rows.map((row, index) => index),

        matchingRowIndices() {
            const query = this.searchQuery.trim().toLocaleLowerCase('vi');
            const visible = new Set();

            sections.forEach((session) => {
                if (this.selectedRoom && session.room.id !== this.selectedRoom) {
                    return;
                }
                if (this.selectedSession && session.number !== this.selectedSession) {
                    return;
                }

                const context = `${session.room.label} ${session.text}`.toLocaleLowerCase('vi');
                const entries = session.entries.filter((entry) => !query || `${context} ${entry.text}`.includes(query));

                if (entries.length) {
                    visible.add(session.room.index);
                    visible.add(session.index);
                    entries.forEach((entry) => visible.add(entry.index));
                }
            });

            return [...visible];
        },

        resetFilters() {
            this.searchQuery = '';
            this.selectedRoom = '';
            this.selectedSession = '';
        },
    };
}
