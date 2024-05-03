using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;
using montisgal_events.Data.Entities;

namespace montisgal_events.Data;

public class ApplicationDbContext : IdentityDbContext
{
    public DbSet<Group> Groups { get; set; }
    
    public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options) : base(options)
    {
    }
}