using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;
using montisgal_events.mvc.Data.Entities;

namespace montisgal_events.mvc.Data;

public class ApplicationDbContext(DbContextOptions<ApplicationDbContext> options) : IdentityDbContext(options)
{
    public DbSet<GroupEntity> Groups { get; set; }
}