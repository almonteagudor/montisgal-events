using System.Security.Claims;
using montisgal_events.Data;

namespace montisgal_events.Business.UseCases.Group;

public class UpdateGroupUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<bool> Execute(Guid id, string name, string description, bool isPublic)
    {
        var ownerId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;

        var group = applicationDbContext.Groups.FirstOrDefault(groupEntity => groupEntity.OwnerId == ownerId && groupEntity.Id == id);
        
        if (group == null) { return  false; }

        group.Name = name;
        group.Description = description;
        group.IsPublic = isPublic;

        await applicationDbContext.SaveChangesAsync();

        return true;
    }
}