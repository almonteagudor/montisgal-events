using Microsoft.EntityFrameworkCore;

namespace montisgal_events_api.Models;

public class MontisgalEventsApiContext(DbContextOptions<MontisgalEventsApiContext> options) : DbContext(options)
{
    public DbSet<Event> Events { get; init; }
}
