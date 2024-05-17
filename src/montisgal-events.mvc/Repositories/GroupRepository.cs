using Microsoft.EntityFrameworkCore;
using montisgal_events.domain.Groups;
using montisgal_events.mvc.Data;
using montisgal_events.mvc.Mappers;

namespace montisgal_events.mvc.Repositories;

public class GroupRepository(ApplicationDbContext applicationDbContext) : IGroupRepository
{
    public Task<Group?> GetGroup(Guid id, Guid ownerId)
    {
        throw new NotImplementedException();
    }

    public async Task<List<Group>> GetGroups(Guid ownerId)
    {
        var groups = await applicationDbContext.Groups.Where(
            group => group.OwnerId == ownerId.ToString()
        ).AsNoTracking().ToListAsync();

        return groups.ToDomainEntity();
    }

    public async Task<bool> InsertGroup(Group group)
    {
        var entity = group.ToEntity();

        applicationDbContext.Groups.Add(entity);

        return await applicationDbContext.SaveChangesAsync() > 0;
    }

    public Task<bool> UpdateGroup(Group group)
    {
        throw new NotImplementedException();
    }

    public Task<bool> DeleteGroup(Group group)
    {
        throw new NotImplementedException();
    }
}